function init(){
	var State = "rheakaehr0000000000c00000c0p0p0p0p0p000000000000000000P0P0P0P0P0C00000C0000000000RHEAKAEHR";				
	drawBoard(State);
}

function drawBoard(State){
	$(".CCell").attr('src', '');
	for (var i=0; i<10; i++){
		for (var j=0; j<9; j++){
			var n = State.charAt(i*9+j);
			if (n!='0'){
				var IdCell = "#Piece" + j + i;
				switch (n){
					//Cặp sĩ
					case 'a':										
						$(IdCell).attr("src", '/data/chess/150/GAssansin.png');
						break;
					case 'A':
						$(IdCell).attr("src", '/data/chess/150/RAssansin.png');
						break;
					//Cặp ngựa
					case 'h':																				
						$(IdCell).attr("src", '/data/chess/150/GHorse.png');
						break;
					case 'H':
						$(IdCell).attr("src", '/data/chess/150/RHorse.png');
						break;
					//Cặp xe
					case 'r':										
						$(IdCell).attr("src", '/data/chess/150/GRook.png');
						break;
					case 'R':
						$(IdCell).attr("src", '/data/chess/150/RRook.png');
						break;
					//Cặp tượng
					case 'e':										
						$(IdCell).attr("src", '/data/chess/150/GElephant.png');
						break;
					case 'E':
						$(IdCell).attr("src", '/data/chess/150/RElephant.png');
						break;
					//Con tướng
					case 'k':										
						$(IdCell).attr("src", '/data/chess/150/GKing.png');
						break;
					case 'K':
						$(IdCell).attr("src", '/data/chess/150/RKing.png');
						break;
					//Cặp pháo
					case 'c':										
						$(IdCell).attr("src", '/data/chess/150/GCannon.png');
						break;
					case 'C':
						$(IdCell).attr("src", '/data/chess/150/RCannon.png');
						break;	
					
					//Bầy chốt
					case 'p':																				
						$(IdCell).attr("src", '/data/chess/150/GPawn.png');
						break;
					case 'P':										
						$(IdCell).attr("src", '/data/chess/150/RPawn.png');
						break;
						
				}								
			}
		}												
	}
}
