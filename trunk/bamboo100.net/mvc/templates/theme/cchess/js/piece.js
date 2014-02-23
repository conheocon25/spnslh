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
	this.getX	= function(){return this.X;}
	this.getY	= function(){return this.Y;}
	this.setXY	= function(X, Y){this.X = X; this.Y = Y;}
	
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