//--------------------------------------------------------------------
//LỚP PIECE biểu diễn QUÂN CỜ
//--------------------------------------------------------------------
//Name: tên quân cờ {King, Rook, Bishop, Elephant, Canon, Horse, Pawn}
//Type: màu quân cờ {R, G} tương đương với {Đỏ, Xanh}
//X, Y: vị trí quân cờ, vị trí ảo chưa tính tọa độ thực tế.
function Board(Name, XStart, YStart, Rect, wCell, hCell){
	this.Name 			= Name;
	this.XStart			= XStart;
	this.YStart			= YStart;
	this.nWidthCell  	= wCell;
	this.nHeightCell	= hCell;
	this.nWPiece  		= 32;
	this.nHPiece 		= 32;
	this.Space			= 2;
	this.Stick			= 4;
	this.APiece 		= [];
	this.Rect 			= Rect;
	
	this.CurrentStep 	= 0;
	
	this.AStep 			= [];
	this.AStepN			= [];
	
	this.First 			= 1; //1 => Đỏ đi trước -1 => Xanh đi trước	
	this.Current 		= 1; //1 => Đỏ đi trước -1 => Xanh đi trước
	
	this.iSelected		= -1;
	
	this.Mode			= 1;
			
	//VỊ TRÍ PHÂN BỔ CỦA CÁC ĐỐI TƯỢNG QUÂN CỜ [0...31] VỊ TRÍ CỦA QUÂN CỜ | -1 LÀ VỊ TRÍ TRỐNG
	this.Object	= [
		[ 7,  5,  3,  1,  0,  2,  4,  6,  8],
		[-1, -1, -1, -1, -1, -1, -1, -1, -1],
		[-1,  9, -1, -1, -1, -1, -1, 10, -1],
		[11, -1, 12, -1, 13, -1, 14, -1, 15],
		[-1, -1, -1, -1, -1, -1, -1, -1, -1],
		[-1, -1, -1, -1, -1, -1, -1, -1, -1],
		[27, -1, 28, -1, 29, -1, 30, -1, 31],
		[-1, 25, -1, -1, -1, -1, -1, 26, -1],
		[-1, -1, -1, -1, -1, -1, -1, -1, -1],
		[23, 21, 19, 17, 16, 18, 20, 22, 24]
	];
	
	this.getX2Canvas 	= function(X) {return this.XStart + X*this.nWidthCell + X*this.Space;}
	this.getY2Canvas	= function(Y){return this.YStart + Y*this.nHeightCell + Y*this.Space;}
		
	//--------------------------------------------------------------------
	//KHỞI TẠO BÀN CỜ
	//--------------------------------------------------------------------
	this.init 			= function(){
		this.APiece[0] = 	new Piece("King", 		"G", 4, 0);
		this.APiece[1] = 	new Piece("Bishop", 	"G", 3, 0);
		this.APiece[2] = 	new Piece("Bishop", 	"G", 5, 0);
		this.APiece[3] = 	new Piece("Elephant", 	"G", 2, 0);
		this.APiece[4] = 	new Piece("Elephant", 	"G", 6, 0);
		this.APiece[5] = 	new Piece("Horse", 		"G", 1, 0);
		this.APiece[6] = 	new Piece("Horse", 		"G", 7, 0);
		this.APiece[7] = 	new Piece("Rook", 		"G", 0, 0);
		this.APiece[8] = 	new Piece("Rook", 		"G", 8, 0);
		this.APiece[9] = 	new Piece("Canon", 		"G", 1, 2);
		this.APiece[10] = 	new Piece("Canon", 		"G", 7, 2);
		this.APiece[11] = 	new Piece("Pawn", 		"G", 0, 3); 
		this.APiece[12] = 	new Piece("Pawn", 		"G", 2, 3); 
		this.APiece[13] = 	new Piece("Pawn", 		"G", 4, 3); 
		this.APiece[14] = 	new Piece("Pawn", 		"G", 6, 3); 
		this.APiece[15] = 	new Piece("Pawn", 		"G", 8, 3);
			
		this.APiece[16] = 	new Piece("King", 		"R", 4, 9);
		this.APiece[17] = 	new Piece("Bishop", 	"R", 3, 9);
		this.APiece[18] = 	new Piece("Bishop", 	"R", 5, 9);
		this.APiece[19] = 	new Piece("Elephant", 	"R", 2, 9);
		this.APiece[20] = 	new Piece("Elephant", 	"R", 6, 9);
		this.APiece[21] = 	new Piece("Horse", 		"R", 1, 9);
		this.APiece[22] = 	new Piece("Horse", 		"R", 7, 9);
		this.APiece[23] = 	new Piece("Rook", 		"R", 0, 9);
		this.APiece[24] = 	new Piece("Rook", 		"R", 8, 9);
		this.APiece[25] = 	new Piece("Canon", 		"R", 1, 7);
		this.APiece[26] = 	new Piece("Canon", 		"R", 7, 7);
		this.APiece[27] = 	new Piece("Pawn", 		"R", 0, 6); 
		this.APiece[28] = 	new Piece("Pawn", 		"R", 2, 6); 
		this.APiece[29] = 	new Piece("Pawn", 		"R", 4, 6); 
		this.APiece[30] = 	new Piece("Pawn", 		"R", 6, 6); 
		this.APiece[31] = 	new Piece("Pawn", 		"R", 8, 6);		
	}
	
	this.setState 	= function(Str){
		var arrStr = Str.split(' ');
		for (var i=0; i < 32; i++){
			var S = arrStr[i];
			var X = this.APiece[i].getX();
			var Y = this.APiece[i].getY();
			
			if (S=="DD"){				
				if (X =! -1){
					this.Object[Y][X] = -1;					
				}
				this.APiece[i].setXY(-1, -1);
			}
			else{
				if (X =! -1){
					this.Object[Y][X] = -1;
				}
				this.Object[S[1]][S[0]] = i;
				this.APiece[i].setXY(S[0], S[1]);						
			}
		}
	}
	this.getState 	= function(){
		var Str = "";
		for (var i=0; i < 32; i++){
			if (this.APiece[i].getX()==-1){
				Str = Str + "DD ";
			}else{
				Str = Str + this.APiece[i].getX()+this.APiece[i].getY()+" ";
			}			
		}
		return Str;
	}
	
	//--------------------------------------------------------------------
	//SỰ KIỆN CLICK CHUỘT
	//--------------------------------------------------------------------
	this.move = function(iPiece, XNew, YNew){
		var OldX = Math.floor(this.APiece[iPiece].getX()) + 1;
		
		//CHẾ ĐỘ CỜ THẾ
		if (this.Mode > 0){
			//Lưu lại trong CSDL		
			this.AStepN[this.CurrentStep] 	= this.APiece[iPiece].getMoveDescription(XNew, YNew);
			
			//Thiết lập vị trí cũ
			this.Object[this.APiece[iPiece].getY()][this.APiece[iPiece].getX()] = -1;
			
			//Thiết lập vị trí mới
			this.Object[YNew][XNew] = iPiece;
			this.APiece[iPiece].setXY(XNew, YNew);
			
			this.AStep[this.CurrentStep] 	= this.getState();
					
			this.CurrentStep ++;
		}else{ //CHẾ ĐỘ THIẾT LẬP
			//Thiết lập vị trí cũ
			this.Object[this.APiece[iPiece].getY()][this.APiece[iPiece].getX()] = -1;
			
			//Thiết lập vị trí mới
			this.Object[YNew][XNew] = iPiece;
			this.APiece[iPiece].setXY(XNew, YNew);														
		}	
	}
	
	this.click = function(e){
		var CellX 	= Math.floor((e.clientX-this.Rect.left-30)/this.nWidthCell);
		var CellY 	= Math.floor((e.clientY-this.Rect.top-30)/this.nHeightCell);
		var Id 		= -1;
		var IdTemp  = -1;
		
		//Ở CHẾ ĐỘ BÌNH THƯỜNG
		if (this.getMode() > 0 ){
			if (this.iSelected != -1){
				//Di chuyển
				if (this.Object[CellY][CellX] == -1){
					this.move(this.iSelected, CellX, CellY);
					this.iSelected = -1;
					this.Current *= -1;
				}			
				else{
					//Bỏ chọn quân 
					if (this.Object[CellY][CellX] == this.iSelected){
						this.iSelected = -1;
					}//Ăn quân
					else{
						IdTemp = this.Object[CellY][CellX];
						if (this.APiece[IdTemp].getType() != this.APiece[this.iSelected].getType()){
							this.Object[CellY][CellX] = -1;
							this.APiece[IdTemp].setXY(-1, -1);
							
							this.move(this.iSelected, CellX, CellY);
							this.iSelected = -1;
							this.Current  *= -1;
						}
					}				
				}
			}else{
				Id = this.Object[CellY][CellX];
				if (Id != -1){
					//Đỏ đi
					if (this.Current > 0 && Id>15){
						this.iSelected = Id;
					}else if (this.Current < 0 && Id<16){
						this.iSelected = Id;
					}
				}
				
			}
		}
		//Ở CHẾ ĐỘ THIẾT LẬP
		else{			
			if (this.iSelected != -1){
				//Di chuyển
				if (this.Object[CellY][CellX] == -1){
					this.move(this.iSelected, CellX, CellY);
					this.iSelected = -1;
					this.Current *= -1;
				}			
				else{
					//Bỏ chọn quân 
					if (this.Object[CellY][CellX] == this.iSelected){
						this.iSelected = -1;
					}
				}
			}else{
				Id = this.Object[CellY][CellX];
				if (Id != -1){					
					this.iSelected = Id;
				}				
			}
		}
	}
	
	this.getStepAll = function(){		
		var S = "";
		var Temp = "";
		var First = this.First;
		for (var i=0; i < this.CurrentStep; i++){
			if (First>0){
				Temp = "<div class='btn btn-danger iStep' 	alt='"+ this.AStep[i] +"'>"+ this.AStepN[i] + "</div>";
			}else{
				Temp = "<div class='btn btn-info iStep' 	alt='"+ this.AStep[i] +"'>"+ this.AStepN[i] + "</div><br/>";
			}
			First *= -1;
			S +=  Temp;
		}		
		return S;
	}
	
	this.getStepAllSave = function(){
		var S = "";
		var Temp = "";
		for (var i=0; i < this.CurrentStep; i+=2){
			Temp = "#"+this.AStepN[i] + "|" + this.AStep[i] + "|" + this.AStepN[i+1] + "|" + this.AStep[i+1];
			S +=  Temp;
		}
		return S;
	}
	
	this.getStepAllLoad = function(DataMove){		
		var arrMove = DataMove.split('#');
		var arrStep;
		this.CurrentStep = 0;
		
		for (var i=0; i < arrMove.length; i++){
			if (arrMove[i]!=""){				
				arrStep = arrMove[i].split("|");											
				this.AStepN[this.CurrentStep] = arrStep[0];
				this.AStep[this.CurrentStep]  = arrStep[1];
				this.CurrentStep ++;				
			}
		}
	}
	
	//--------------------------------------------------------------------
	//VẼ BÀN CỜ
	//--------------------------------------------------------------------
	this.drawNode = function(context, col, row){		
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)-this.Stick - 10,	this.YStart + row*(this.nHeightCell+this.Space)-this.Stick - 1);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 10,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 9);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 9,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 8);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 9,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 18);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 8);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 18);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 9);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick + 8,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 9);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick + 8,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 1);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 2,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 1);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick + 8);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 18,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 1);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 8,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 1);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 9,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 9,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick + 8);
	}
	
	this.drawNodeLeft = function(context, col, row){		
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 8);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 18);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 9);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick + 8,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 9);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick + 8,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 1);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 2,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 1);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 1,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick + 8);
	}
	
	this.drawNodeRight = function(context, col, row){		
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)-this.Stick - 10,	this.YStart + row*(this.nHeightCell+this.Space)-this.Stick - 1);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 10,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 9);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 9,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 8);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 9,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 18);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 18,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 1);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 8,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick - 1);
		context.moveTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 9,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick);
		context.lineTo(this.XStart + col*(this.nWidthCell+this.Space)+this.Stick - 9,	this.YStart + row*(this.nHeightCell+this.Space)+this.Stick + 8);
	}
	
	//--------------------------------------------------------------------
	//VẼ BÀN CỜ
	//--------------------------------------------------------------------
	this.draw = function(canvas, context){
		var width;		
		//Vẽ các ô trong bàn cờ		
		for (var i=0; i<9; i++){
			for (var j=0; j<8; j++){
				if(i==4){
					//Vẽ hà
					context.fillStyle = "#D7ECF2";
					if(j!=7) { width = this.nWidthCell+2; }
					else { width = this.nWidthCell; }
				} else {
					context.fillStyle = "lightblue";
					width = this.nWidthCell;
				}
				context.fill();
				context.fillRect( 
					this.XStart + j*(this.nWidthCell+this.Space), 
					this.YStart + i*(this.nHeightCell+this.Space), 
					width, 
					this.nHeightCell
				);
			}
		}
		
		//===============================================================================
		// Vẽ các số tọa độ & Chữ giữa hà
		//===============================================================================
		context.font=(wCell/3)+"px Tahoma";
		context.fillStyle = "green";
		var k=1;
		for(var i=XStart; i<=wCell*9; i+=(wCell+1)) {
			context.fillText(k, 	i, (wCell/10)+6);
			context.fillText(10-k, 	i, (hCell*10)+12);
			k++;
		}
		context.font = (wCell/2) + "px CustomFont";
		context.fillStyle = "#545353";
		context.fillText("Hạ Thủ Bất Hoàn", (wCell*3)+((wCell*3)/8), (hCell*5)+((hCell*5)/10));

		
		//===============================================================================
		//Vẽ các đường chéo														
		//===============================================================================
		context.beginPath();
		context.strokeStyle = "#ECEAEF";
		context.lineWidth = 2;
		//Chéo cung bên XANH
		context.moveTo(this.XStart + 3*(this.nWidthCell+this.Space)				, this.YStart + 0*(this.nHeightCell+this.Space));
		context.lineTo(this.XStart + 5*(this.nWidthCell+this.Space)-this.Space 	, this.YStart + 2*(this.nHeightCell+this.Space)-this.Space);
		context.moveTo(this.XStart + 5*(this.nWidthCell+this.Space)-2			, this.YStart + 0*(this.nHeightCell+this.Space));
		context.lineTo(this.XStart + 3*(this.nWidthCell+this.Space)-this.Space	, this.YStart + 2*(this.nHeightCell+this.Space)-this.Space+2);
			
		//Vị trí Pháo bên XANH
		this.drawNode(context, 1, 2);
		this.drawNode(context, 7, 2);

		//Vị trí Chốt bên XANH
		this.drawNodeLeft(context, 0, 3);
		this.drawNode(context, 2, 3);
		this.drawNode(context, 4, 3);
		this.drawNode(context, 6, 3);
		this.drawNodeRight(context, 8, 3);
		
		//Chéo cung bên ĐỎ
		context.moveTo(this.XStart + 3*(this.nWidthCell+this.Space)					, this.YStart + 7*(this.nHeightCell+this.Space));
		context.lineTo(this.XStart + 5*(this.nWidthCell+this.Space)-this.Space		, this.YStart + 9*(this.nHeightCell+this.Space)-this.Space);			
		context.moveTo(this.XStart + 3*(this.nWidthCell+this.Space)-this.Space+2	, this.YStart + 9*(this.nHeightCell+this.Space)-this.Space);
		context.lineTo(this.XStart + 5*(this.nWidthCell+this.Space)-this.Space+2	, this.YStart + 7*(this.nHeightCell+this.Space)-this.Space);
		
		//Vị trí Pháo bên ĐỎ
		this.drawNode(context, 1, 7);
		this.drawNode(context, 7, 7);

		//Vị trí Chốt bên XANH
		this.drawNodeLeft(context, 0, 6);
		this.drawNode(context, 2, 6);
		this.drawNode(context, 4, 6);
		this.drawNode(context, 6, 6);
		this.drawNodeRight(context, 8, 6);

		context.stroke();		
		for (var i=0; i<this.APiece.length; i++) {			
			var X = this.getX2Canvas(this.APiece[i].getX()) - this.nWPiece/2;
			var Y = this.getY2Canvas(this.APiece[i].getY()) - this.nHPiece/2;
			context.drawImage(this.APiece[i].getImage(), X, Y, this.nWPiece, this.nHPiece);
		}
				
		//Vẽ con cờ được chọn
		if (this.iSelected != -1){
			var i = this.iSelected;
			var X = this.getX2Canvas(this.APiece[i].getX()) - this.nWPiece/2;
			var Y = this.getY2Canvas(this.APiece[i].getY()) - this.nHPiece/2;
			context.drawImage(this.APiece[0].getImageSelected(), X, Y, this.nWPiece, this.nHPiece);
		}
		
	}
	
	//--------------------------------------------------------------------
	//ĐỔI CHẾ ĐỘ 1 - DI CHUYỂN  -1 THIẾT LẬP QUÂN
	//--------------------------------------------------------------------
	this.setMode = function(mode){
		if (this.Mode < 0){
			this.AStep 			= [];
			this.AStepN			= [];
			this.CurrentStep 	= 0;
			this.First 			= 1;
			this.Current		= 1;
			this.iSelected		= -1;			
		}			
		this.Mode = mode;
	}
	this.getMode = function(){return this.Mode;}
	
	//Phải ở chế độ THIẾT LẬP QUÂN
	this.delCurrent = function(){
		if (this.Mode < 0){
			if (this.iSelected > 0){											
				this.Object[this.APiece[this.iSelected].getY()][this.APiece[this.iSelected].getX()] = -1;
				this.APiece[this.iSelected].setXY(-1, -1);
				this.iSelected = -1;
			}
		}
	}
	
	//--------------------------------------------------------------------
	//UNDO/REDO nước đi
	//--------------------------------------------------------------------
	this.undo = function(){
		if (this.Mode < 0){
			this.CurrentStep --;
		}
	}
	
	this.redo = function(){
		if (this.Mode < 0){
			this.CurrentStep ++;
		}
	}
}