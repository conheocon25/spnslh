//--------------------------------------------------------------------
//LỚP PIECE biểu diễn QUÂN CỜ
//--------------------------------------------------------------------
//Name: tên quân cờ {King, Rook, Bishop, Elephant, Canon, Horse, Pawn}
//Type: màu quân cờ {R, G} tương đương với {Đỏ, Xanh}
//X, Y: vị trí quân cờ, vị trí ảo chưa tính tọa độ thực tế.
function Piece(Name, Type, X, Y){
	this.isLived	= true;
	this.Name 		= Name;
	
	this.Type 		= Type;
	this.getType	= function(){return this.Type;}
	this.setType	= function(Type){this.Type = Type;}
	
	this.X			= X;
	this.Y			= Y;
	this.Image		= new Image();
	this.Image.src 			= "/mvc/templates/theme/cchess/img/"+this.Type+ this.Name+".gif";
	this.ImageSelected		= new Image();
	this.ImageSelected.src 	= "/mvc/templates/theme/cchess/img/Selected.gif";
	
	this.Hash				= {};
	this.Hash['Canon']		= "Pháo";
	this.Hash['Bishop']		= "Sĩ";
	this.Hash['Elephant'] 	= "Tượng";
	this.Hash['Rook'] 		= "Xe";
	this.Hash['Horse'] 		= "Mã";
	this.Hash['Pawn'] 		= "Chốt";
	this.Hash['King'] 		= "Tướng";
	
	//THIẾT LẬP TỌA ĐỘ
	this.getX				= function(){return this.X;}
	this.getY				= function(){return this.Y;}
	this.setXY				= function(X, Y){this.X = X; this.Y = Y;}
	
	//Mô tả ngắn gọn về nước đi của quân cờ
	this.getMoveDescription = function(XNew, YNew){
		var S 		= "";
		var Move 	= "";
		var Type1	= (this.Type=="R")?1:-1;
		var Type2	= (this.Type=="R")?0:1;
		
		var XOld	= Math.floor(this.getX());
		var YOld	= Math.floor(this.getY());
		var DX		= Math.floor(XNew - XOld);
		var DY		= Type1*Math.floor(YNew - YOld);
						
		if (DY==0){
			Move = ( Type1*(XOld + 1) + 10*Type2) + " bình " + ( Type1*(XNew + 1) + 10*Type2);
		}else{
			if (DY < 0){
				if (this.Name=="Bishop" || this.Name=="Horse" ||this.Name=="Elephant"){
					Move = (Type1*(XOld + 1) + 10*Type2) + " tiến " + ( Type1*(XNew + 1) + 10*Type2);
				}else{					
					Move = (Type1*(XOld + 1) + 10*Type2) + " tiến " + Math.abs(DY);
				}
			}				
			else{
				if (this.Name=="Bishop" || this.Name=="Horse" ||this.Name=="Elephant"){
					Move = (Type1*(XOld + 1) + 10*Type2) + " thoái " + ( Type1*(XNew + 1) + 10*Type2);
				}else{
					Move = (Type1*(XOld + 1) + 10*Type2) + " thoái " + Math.abs(DY);
				}
			}
		}
		S = this.getNameShort() + " " + Move;
		return S;
	}
	
	//THIẾT LẬP VẼ
	this.getImage 		= function(){return this.Image;}
	this.getImageSelected	= function(){return this.ImageSelected;}
	this.getFileName	= function(){return "img/"+this.Type+this.Name+".gif";}
	this.getName		= function(){return this.Name;}
	this.getNameShort	= function(){		
		return this.Hash[this.Name];
	}
	
	//KIỂM TRA NƯỚC ĐI HỢP LỆ
	
}