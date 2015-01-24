var aState = [
	['r', 'h', 'e', 'a', 'k', 'a', 'e', 'h', 'r'], //0
	['0', '0', '0', '0', '0', '0', '0', '0', '0'], //1
	['0', 'c', '0', '0', '0', '0', '0', 'c', '0'], //2
	['p', '0', 'p', '0', 'p', '0', 'p', '0', 'p'], //3
	['0', '0', '0', '0', '0', '0', '0', '0', '0'], //4					
	['0', '0', '0', '0', '0', '0', '0', '0', '0'], //5
	['P', '0', 'P', '0', 'P', '0', 'P', '0', 'P'], //6
	['0', 'C', '0', '0', '0', '0', '0', 'C', '0'], //7
	['0', '0', '0', '0', '0', '0', '0', '0', '0'], //8
	['R', 'H', 'E', 'A', 'K', 'A', 'E', 'H', 'R']  //9
];
var aStep 	= [];
var aStepA 	= [];

var iStep 	= 0;
var iStepT 	= 0;
var Round 	= -1;

function isColor(C){
	if (C=='r' || C=='h' || C=='e' || C=='a' || C=='k' || C=='p' || C=='c')
		return 1;
	else if (C=='R' || C=='H' || C=='E' || C=='A' || C=='K' || C=='P' || C=='C')
		return -1;
	return 0;
}

function exportState(){
	var i=0, j=0;
	var State = "";
	for (i=0;i<10;i++){
		for (j=0;j<9;j++){
			State = State + aState[i][j];
		}	
	}
	return State;
}

function movePiece(Y, X, NY, NX){
	X = parseInt(X);
	Y = parseInt(Y);
	NX = parseInt(NX);
	NY = parseInt(NY);
	
	aState[NY][NX] 	= aState[Y][X];
	aState[Y][X]	= '0';
}

function exportStep(Y, X, NY, NX){
	var S = "";
	X = parseInt(X);
	Y = parseInt(Y);
	NX = parseInt(NX);
	NY = parseInt(NY);
	
	if (aState[Y][X]=='r' || aState[Y][X]=='R')
		S = "X";
	else if (aState[Y][X]=='h' || aState[Y][X]=='H')
		S = "M";
	else if (aState[Y][X]=='e' || aState[Y][X]=='E')
		S = "B";
	else if (aState[Y][X]=='a' || aState[Y][X]=='A')
		S = "S";
	else if (aState[Y][X]=='k' || aState[Y][X]=='K')
		S = "T";
	else if (aState[Y][X]=='c' || aState[Y][X]=='C')
		S = "P";
	else if (aState[Y][X]=='p' || aState[Y][X]=='P')
		S = "C";
	
	//Xác định hướng tọa độ
	if (aState[Y][X]=='r' || aState[Y][X]=='h' || aState[Y][X]=='e' || aState[Y][X]=='a'  || aState[Y][X]=='k' || aState[Y][X]=='c' || aState[Y][X]=='p'){
		
		if (Y==NY){
			S += " " + (X+1) + " - " +  (NX+1);
		}			
		else{
			if (X==NX){
				if (Y>NY)
					S += " " + (X+1) + " / " +  (Y-NY);
				else
					S += " " + (X+1) + " . " +  (NY-Y);
			}				
			else{
				if (Y>NY)
					S += " " + (X+1) + " / " +  (NX+1);
				else
					S += " " + (X+1) + " . " +  (NX+1);
			}
		}				
	}else{
		if (Y==NY){
			S += " " + (10- (X+1)) + " - " +  (10-(NX+1));
		}else{
		
			if (X==NX){
				if (Y>NY)
					S += " " + (10-(X+1)) + " . " +  (Y-NY);
				else
					S += " " + (10-(X+1)) + " / " +  (NY-Y);
			}				
			else{
				if (Y>NY)
					S += " " + (10-(X+1)) + " . " +  (10-(NX+1));
				else
					S += " " + (10-(X+1)) + " / " +  (10-(NX+1));
			}					
		}
	}
	return S;
}

//KHỞI TẠO VỊ TRÍ CÁC QUÂN CỜ TRƯỚC KHI SOẠN NƯỚC
function initCompose(State){
	drawBoard(State);
	iStep = 0;
	
	for (var i=0; i<10; i++){
		for (var j=0; j<9; j++){			
			aState[i][j] = State.charAt(i*9+j);
		}
	}
}

function initViewer(State){
	if (State=="") State = "000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000";
	drawBoard(State);
	for (var i=0; i<10; i++){
		for (var j=0; j<9; j++){			
			aState[i][j] = State.charAt(i*9+j);
		}
	}	
}

function initState(){	
	var i=0, j=0;	
	for (i=0;i<10;i++){
		for (j=0;j<9;j++){
			aState[i][j]='0';
		}
	}	
	var State = exportState();	
	drawBoard(State);
}


function drawRound(Round){
	$("#RoundRed").attr('src', '');
	$("#RoundGreen").attr('src', '');
	if (Round<0){
		$("#RoundRed").attr("src", '/data/chess/150/CircleRed.png');
	}else{
		$("#RoundGreen").attr("src", '/data/chess/150/CircleGreen.png');
	}
}

function drawRound1(Round){
	$("#RoundRed").attr('src', '');
	$("#RoundGreen").attr('src', '');
	if (Round % 2 === 0){
		$("#RoundRed").attr("src", '/data/chess/150/CircleRed.png');
	}else{
		$("#RoundGreen").attr("src", '/data/chess/150/CircleGreen.png');
	}
}

function drawIState(Index){
	$(".MoveState").html("<B>" + (Index) + " / " + iStep + "</B>");
}

function drawMoveState(){
	var I1 = Math.floor(iStep/2) + 1;
	var I2 = (iStep%2) + 1;	
	if (Round>0)
		$('#StateList tr:last').after("<tr><td align='center'><font color='red'><B>"+ I1 + "</B>." + I2 +"</font></td><td><font color='red'>"+aStepA[iStep]+"</font></td></tr>");
	else
		$('#StateList tr:last').after("<tr><td align='center'><font color='green'><B>"+ I1 + "</B>." + I2 +"</font></td><td><font color='green'>"+aStepA[iStep]+"</font></td></tr>");
}

function drawBoard(State){
	$(".CCell").attr('src', '');
	for (var i=0; i<10; i++){
		for (var j=0; j<9; j++){
			var n = State.charAt(i*9+j);
			var IdCell = "#Piece" + j + i;
			if (n!='0'){
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
			}else{
				$(IdCell).attr("src", '/data/chess/150/space.png');
			}
		}												
	}
}
