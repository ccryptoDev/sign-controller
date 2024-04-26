function charToLED(theChar){
    var theLed = [];
    switch(theChar) {
        case 'A' :
            // theLed = [
            //             [false,false,true,true,false,false,false,true,true,true],
            //             [true,false,true,true,false,false,true,true,true,false],
            //             [false,false,false,true,true,false,false,false,false,true],
            //             [true,true,true,true,true,true,true,false,false,false],
            //             [false,true,true,false,false,false,false,true,true,false],
            //             [false,false,false,true,true,false,false,false,false,true]
            //         ];
            theLed = [
                        [false,false,true,true,false,false], 
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,true,true,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'B' :
            theLed = [
                        [true,true,true,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,true,true],
                        [true,true,true,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,true,true],
                        [true,true,true,true,true,false]
                    ];
            break;
        case 'C' :
            theLed = [
                        [false,false,true,true,false,false],
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false],
                        [false,false,true,true,false,false]  
                    ]; 
            break;
        case 'D' :
            theLed = [
                        [true,true,true,true,false,false],
                        [true,false,false,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,true,true],
                        [true,false,false,true,true,false],
                        [true,true,true,true,false,false]
                    ];
            break;
        case 'E' :
            theLed = [
                        [true,true,true,true,true,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,true,false,false,false],
                        [true,true,true,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,true,true,true,true]
                    ];
            break;
        case 'F' :
            theLed = [
                        [true,true,true,true,true,true],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,true,false,false,false],
                        [true,true,true,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false]
                    ];
            break;
        case 'G' :
            theLed = [
                        [false,false,true,true,false,false],
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,true,true,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false],
                        [false,false,true,true,false,false]
                    ];
            break;
        case 'H' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'I' :
            theLed = [
                        [false,true,true,true,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,true,true,true,true,false]
                    ];
            break;
        case 'J' :
            theLed = [
                        [false,true,true,true,true,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,true,false,true,false,false],
                        [false,true,true,true,false,false],
                        [false,false,true,false,false,false]
                    ];
            break;  
        case 'K' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,false,false,false,true,true],
                        [true,false,false,true,true,false],
                        [true,false,true,true,false,false],
                        [true,true,true,false,false,false],
                        [true,true,true,false,false,false],
                        [true,false,true,true,false,false],
                        [true,false,false,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true] 
                    ];
            break;
        case 'L' :
            theLed = [
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,true,true,true,true]  
                    ];
            break;
        case 'M' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [true,true,true,true,true,true],
                        [true,false,true,true,false,true],
                        [true,false,true,true,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'N' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,true,false,false,false,true],
                        [true,true,true,false,false,true],
                        [true,true,true,true,false,true],
                        [true,false,true,true,false,true],
                        [true,false,false,true,true,true],
                        [true,false,false,false,true,true],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'O' :
            theLed = [
                        [false,false,true,true,false,false],
                        [false,true,true,true,true,false],
                        [false,true,false,false,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,false,false,true,false],
                        [false,true,true,true,true,false],
                        [false,false,true,true,false,false]
                    ];
            break;
        case 'P' :
            theLed = [
                        [true,true,true,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,true,true],
                        [true,true,true,true,true,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false]
                    ];
            break;
        case 'Q' :
            theLed = [
                        [false,false,true,true,false,false],
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [true,true,false,false,true,false],
                        [false,true,true,true,false,false],
                        [false,false,false,true,true,false],
                        [false,false,false,false,true,true]
                    ];
            break;
        case 'R' :
            theLed = [
                        [true,true,true,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,true,true],
                        [true,true,true,true,true,false],
                        [true,true,true,false,false,false],
                        [true,false,true,true,false,false],
                        [true,false,false,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'S' :
            theLed = [
                        [false,true,true,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,false],
                        [true,true,false,false,false,false],
                        [false,true,true,true,false,false],
                        [false,false,true,true,true,false],
                        [false,false,false,false,true,true],
                        [false,false,false,false,false,true],
                        [true,true,false,false,false,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case 'T' :
            theLed = [
                        [true,true,true,true,true,true],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false]  
                    ];
            break;
        case 'U' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [true,true,true,true,true,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case 'V' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false],
                        [false,true,true,true,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false] 
                    ];
            break;
        case 'W' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,true,true,false,true],
                        [true,false,true,true,false,true],
                        [true,true,true,true,true,true],
                        [true,true,false,false,true,true],
                        [false,true,false,false,true,false]
                    ];
            break;
        case 'X' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,false,false,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,true,false,false,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'Y' :
            theLed = [
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,false,false,true,false],
                        [false,true,true,true,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false]
                    ];
            break;
        case 'Z' :
            theLed = [
                        [true,true,true,true,true,true],
                        [true,false,false,false,false,true],
                        [false,false,false,false,true,true],
                        [false,false,false,true,true,false],
                        [false,false,false,true,false,false],
                        [false,false,true,false,false,false],
                        [false,true,true,false,false,false],
                        [true,true,false,false,false,false],
                        [true,false,false,false,false,true],
                        [true,true,true,true,true,true]
                    ];
            break;
        case 'a' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,true,true,true,true,false],
                        [false,false,false,false,true,true],
                        [false,false,false,false,false,true],
                        [false,true,true,true,true,true],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]  
                    ];
            break;
        case 'b' :
            theLed = [
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,true,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,true,true],
                        [true,true,true,true,true,false]
                    ];
            break;
        case 'c' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]        
                    ];
            break;
        case 'd' :
            theLed = [
                        [false,false,false,false,false,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,false,true],
                        [false,true,true,true,true,true],
                        [true,true,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,false,true],
                        [false,true,true,true,true,true]             
                    ];
            break;
        case 'e' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,true,true,true,true,true],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case 'f' :
            theLed = [
                        [false,false,false,true,true,true],
                        [false,false,true,true,false,false],
                        [false,false,true,false,false,false],
                        [true,true,true,true,true,true],
                        [false,false,true,false,false,false],
                        [false,false,true,false,false,false],
                        [false,false,true,false,false,false],
                        [false,false,true,false,false,false],
                        [false,false,true,false,false,false],
                        [false,false,true,false,false,false]
                    ];
            break;
        case 'g' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,true,true,true,true,true],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,true],
                        [false,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case 'h' :
            theLed = [
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,true,true,true,false],
                        [true,true,true,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'i' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false]
                    ];
            break;
        case 'j' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,true,true,false,false,false],
                        [true,true,false,false,false,false]
                    ];
            break;  
        case 'k' :
            theLed = [
                [true,false,false,false,false,false],
                [true,false,false,false,false,false],
                [true,false,false,false,false,false],
                [true,false,false,false,true,true],
                [true,false,false,true,true,false],
                [true,false,true,true,false,false],
                [true,true,true,true,false,false],
                [true,false,true,true,false,false],
                [true,false,false,true,true,false],
                [true,false,false,false,true,true]
            ];
            break;
        case 'l' :
            theLed = [
                        [false,true,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,true,true,true,true,false]
                    ];
            break;
        case 'm' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [true,false,true,true,false,true],
                        [true,false,true,true,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'n' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,false,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true]
                    ];
            break;
        case 'o' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,true,false,false,true,false],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [false,true,false,false,true,false],
                        [false,false,true,true,false,false]
                    ];
            break;
        case 'p' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,true,true,true,true,false],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,true,true,true,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false]
                    ];
            break;
        case 'q' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,true,true,true,true,true],
                        [true,true,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,false,true],
                        [false,true,true,true,true,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,false,true]   
                    ];
            break;
        case 'r' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,false,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false]
                    ];
            break;
        case 's' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,true,false,false,false,false],
                        [false,true,true,true,true,false],
                        [false,false,false,false,true,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case 't' :
            theLed = [
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [true,true,true,true,true,true],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,true,false]
                    ];
            break;
        case 'u' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case 'v' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false] 
                    ];
            break;
        case 'w' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,false,true,true,false,true],
                        [true,false,true,true,false,true],
                        [true,true,true,true,true,true],
                        [false,true,false,false,true,false]
                    ];
            break;
        case 'x' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,true,false,false,true,true],
                        [false,true,false,false,true,false],
                        [false,true,true,true,false,false],
                        [false,false,true,true,true,false],
                        [false,true,false,false,true,false],
                        [true,true,false,false,true,true]   
                    ];
            break;
        case 'y' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]  
                    ];
            break;
        case 'z' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,true,true,true,true,true],
                        [false,false,false,false,true,false],
                        [false,false,false,true,false,false],
                        [false,false,true,false,false,false],
                        [false,true,false,false,false,false],
                        [true,true,true,true,true,true]
                    ];
            break;
        case 'á' :
            theLed = [[false, false, true, false, false, true, false], 
                    [false, false, true, false, true, false, true],
                    [false, false, true, false, true, false, true],
                    [false, true, false, true, true, true, true],
                    [true, false, false, false, false, false, false]];
            break;
        case 'é' :
            theLed = [[false, false, false, true, true, true, false], 
                    [false, false, true, false, true, false, true],
                    [false, false, true, false, true, false, true],
                    [false, true, false, true, true, false, true],
                    [true, false, false, false, false, false, false]];
            break;
        case 'í' :
            theLed = [[false, false, false, false, false, false, false], 
                    [false, true, false, false, false, false, false],
                    [true, false, true, true, true, true, true],
                    [false, false, false, false, false, false, false],
                    [false, false, false, false, false, false, false]];
            break;
        case 'ó' :
            theLed = [[false, false, false, true, true, true, false], 
                    [false, false, true, false, false, false, true],
                    [false, false, true, false, false, false, true],
                    [false, true, false, true, true, true, false],
                    [true, false, false, false, false, false, false]];
            break;
        case 'ú' :
            theLed = [[false, false, true, true, true, true, false], 
                    [false, false, false, false, false, false, true],
                    [false, true, false, false, false, false, true],
                    [true, false, true, true, true, true, true],
                    [false, false, false, false, false, false, false]];
            break;
        case '/' :
            theLed = [
                        [false,false,false,false,false,true],
                        [false,false,false,false,true,true],
                        [false,false,false,false,true,false],
                        [false,false,false,true,true,false],
                        [false,false,false,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,false,false,false],
                        [false,true,true,false,false,false],
                        [false,true,false,false,false,false],
                        [true,true,false,false,false,false]  
                    ];
            break;
        case "\\" :
            theLed = [
                        [true,false,false,false,false,false],
                        [true,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,true,false,false,false],
                        [false,false,true,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,true]  
                    ];
            break;
        case '|' :
            theLed = [[false, false, false, false, false, false, false], 
                    [false, false, false, false, false, false, false],
                    [true, true, true, true, true, true, true],
                    [false, false, false, false, false, false, false],
                    [false, false, false, false, false, false, false]];
            break;
        case '=' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,true,true,true,true,true],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,true,true,true,true,true],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]  
                    ];
            break;
        case '-' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,true,true,true,true,true],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]  
                    ];
            break;
        case '_' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,true,true,true,true,true],
                        [false,false,false,false,false,false]  
                    ];
            break;
        case '´' :
            theLed = [[false, false, true, false, false, false, false], 
                    [false, true, false, false, false, false, false],
                    [true, false, false, false, false, false, false],
                    [false, false, false, false, false, false, false],
                    [false, false, false, false, false, false, false]];
            break;
        case "'" :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,false,false,false],
                        [false,true,true,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]  
                    ];
            break;
        case '"' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,true,false,true,false,false],
                        [false,true,false,true,false,false],
                        [false,true,false,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]  
                    ];
            break;
        case '+' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]
                ];
            break;
        case '*' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,true,false,false,false],
                        [true,false,true,false,true,false],
                        [false,true,true,true,false,false],
                        [true,true,true,true,true,false],
                        [false,true,true,true,false,false],
                        [true,false,true,false,true,false],
                        [false,false,true,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]  
                    ];
            break;
        case '#' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,true,false,false,true,false],
                        [false,true,false,false,true,false],
                        [true,true,true,true,true,true],
                        [false,true,false,false,true,false],
                        [false,true,false,false,true,false],
                        [true,true,true,true,true,true],
                        [false,true,false,false,true,false],
                        [false,true,false,false,true,false],
                        [false,false,false,false,false,false]
                    ];
            break;
        case '$' :
            theLed = [
                        [false,false,true,true,false,false],
                        [false,true,true,true,true,true],
                        [true,false,true,true,false,true],
                        [true,false,true,true,false,false],
                        [false,true,true,true,false,false],
                        [false,false,true,true,true,false],
                        [false,false,true,true,false,true],
                        [true,false,true,true,false,true],
                        [true,true,true,true,true,false],
                        [false,false,true,true,false,false]  
                    ];
            break;
        case '&' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,true,true,true,true,true],
                        [true,true,false,false,false,true],
                        [true,false,false,true,false,true],
                        [true,false,true,true,false,true],
                        [true,false,true,true,false,true],
                        [true,false,false,true,true,true],
                        [true,true,false,false,false,false],
                        [false,true,true,true,true,true],
                        [false,false,false,false,false,false]        
                    ];
            theLed = [
                        [false,false,false,false,false,false],
                        [false,true,true,false,false,false],
                        [true,false,false,true,false,false],
                        [true,false,false,true,false,false],
                        [true,false,false,true,false,false],
                        [false,true,true,false,false,false],
                        [true,false,false,true,false,true],
                        [true,false,false,false,true,false],
                        [true,false,false,true,false,true],
                        [false,true,true,false,false,true]      
                    ];
            break;
        case '^' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]
                    ];
            break;
        case '?' :
            theLed = [
                        [false,true,true,true,false,false],
                        [true,true,false,true,true,false],
                        [true,false,false,false,true,true],
                        [true,false,false,false,true,true],
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false]  
                    ];
            break;
        case '`' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [true,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,true,false,false,false],
                        [false,false,true,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]
                    ];
            break;
        case '!' :
            theLed = [
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false]
                    ];
            break;
        case '~' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,true,true,false,false,true],
                        [true,false,false,true,true,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]        
                    ];
            break;
        case '.' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false]  
                    ];
            break;
        case ',' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,true,false,false,false],
                        [false,false,false,false,false,false]
                    ];
            break;
        case '(' :
            theLed = [
                        [true,true,true,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,true,false],
                        [false,false,false,false,true,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,true,true],
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [true,true,true,false,false,false]  
                    ];
            break;
        case ')' :
            theLed = [
                        [false,false,false,true,true,true],
                        [false,false,true,true,false,false],
                        [false,true,true,false,false,false],
                        [true,true,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,true,false,false,false,false],
                        [false,true,true,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,true,true]  
                    ];
            break;
        case '[' :
            theLed = [
                        [false,true,true,true,false,false],
                        [false,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,false,false,false,false],
                        [false,true,true,true,false,false] 
                    ];
            break;
        case ']' :
            theLed = [
                        [false,false,true,true,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false],
                        [false,false,true,true,true,false] 
                    ];
            break;
        case '{' :
            theLed = [
                        [false,false,false,true,true,true],
                        [false,false,true,true,false,false],
                        [false,false,true,false,false,false],
                        [false,false,true,true,false,false],
                        [true,true,true,false,false,false],
                        [true,true,true,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,true,true]
                    ];
            break;
        case '}' :
            theLed = [
                        [true,true,true,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,true,true],
                        [false,false,false,true,true,true],
                        [false,false,true,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,true,true,false,false],
                        [true,true,true,false,false,false]
                    ];
            break;
        case '<' :
            theLed = [
                        [false,false,false,false,true,true],
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [false,true,true,false,false,false],
                        [true,true,false,false,false,false],
                        [true,true,false,false,false,false],
                        [false,true,true,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,true,false],
                        [false,false,false,false,true,true]
                    ];
            break;
        case '>' :
            theLed = [
                        [true,true,false,false,false,false],
                        [false,true,true,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,true,false],
                        [false,false,false,false,true,true],
                        [false,false,false,false,true,true],
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [false,true,true,false,false,false],
                        [true,true,false,false,false,false]
                    ];
            break;
        case '%' :
            theLed = [
                        [true,true,false,false,false,true],
                        [false,true,false,false,true,true],
                        [true,true,false,true,true,false],
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,false,false,false],
                        [false,true,true,false,false,false],
                        [false,true,false,false,true,true],
                        [true,true,false,false,true,false],
                        [true,false,false,false,true,true]
                    ];
            break;
        case ';' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,false,false,false]  
                    ];
            break;
        case ':' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,true,true,false,false],
                        [false,false,true,true,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]        
                    ];
            break;
        case '@' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,true,true,true,true,true],
                        [true,true,false,false,false,true],
                        [true,false,false,true,false,true],
                        [true,false,true,true,false,true],
                        [true,false,true,true,false,true],
                        [true,false,false,true,true,true],
                        [true,true,false,false,false,false],
                        [false,true,true,true,true,true],
                        [false,false,false,false,false,false]
                    ];
            break;
        case '0' :
            theLed = [
                        
                    ];
            break;
        case '1' :
            theLed = [
                        [false,false,true,true,false,false],
                        [false,true,true,true,false,false],
                        [false,true,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,false,false,true,false,false],
                        [false,true,true,true,true,false]
                    ];
            break;
        case '2' :
            theLed = [
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,true,true],
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [false,false,true,false,false,false],
                        [false,true,false,false,false,false],
                        [true,true,false,false,false,false],
                        [true,true,true,true,true,true]
                    ];
            break;
        case '3' :
            theLed = [
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [false,false,false,false,true,true],
                        [false,false,true,true,true,false],
                        [false,false,true,true,true,false],
                        [false,false,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case '4' :
            theLed = [
                        [false,false,false,false,true,false],
                        [false,false,false,true,true,false],
                        [false,false,true,true,true,false],
                        [false,true,true,false,true,false],
                        [true,true,false,false,true,false],
                        [true,false,false,false,true,false],
                        [true,true,true,true,true,true],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false],
                        [false,false,false,false,true,false]
                    ];
            break;
        case '5' :
            theLed = [
                        [true,true,true,true,true,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [false,true,true,true,true,false],
                        [false,false,false,false,true,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case '6' :
            theLed = [
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [false,true,true,false,false,false],
                        [true,true,false,false,false,false],
                        [true,true,true,true,false,false],
                        [true,true,false,false,true,false],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false],
                        [false,false,true,true,false,false]
                    ];
            break;
        case '7' :
            theLed = [
                        [true,true,true,true,true,true],
                        [false,false,false,false,false,true],
                        [false,false,false,false,true,true],
                        [false,false,false,true,true,false],
                        [false,false,true,true,false,false],
                        [false,true,true,false,false,false],
                        [true,true,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false],
                        [true,false,false,false,false,false]
                    ];
            break;
        case '8' :
            theLed = [
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,false]
                    ];
            break;
        case '9' :
            theLed = [
                        [false,true,true,true,true,false],
                        [true,true,false,false,true,true],
                        [true,false,false,false,false,true],
                        [true,true,false,false,true,true],
                        [false,true,true,true,true,true],
                        [false,false,false,false,true,true],
                        [false,false,false,false,true,true],
                        [false,false,true,true,true,false],
                        [false,true,true,false,false,false],
                        [true,true,false,false,false,false]
                    ];
            break;
        case ' ' :
            theLed = [
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false],
                        [false,false,false,false,false,false]
                    ];
            break;
        case '░' :
            theLed = [
                        [false,true,false,false,true,false],
                        [false,false,true,false,false,true],
                        [true,false,false,true,false,false],
                        [false,true,false,false,true,false],
                        [false,false,true,false,false,true],
                        [true,false,false,true,false,false],
                        [false,true,false,false,true,false],
                        [false,false,true,false,false,true],
                        [true,false,false,true,false,false],
                        [false,true,false,false,true,false]
                    ];
            break;
        case '█' :
            theLed = [
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true],
                        [true,true,true,true,true,true]
                    ];
            break;
        case '▒' :
            theLed = [
                        [false,true,false,true,false,true],
                        [true,false,true,false,true,false],
                        [false,true,false,true,false,true],
                        [true,false,true,false,true,false],
                        [false,true,false,true,false,true],
                        [true,false,true,false,true,false],
                        [false,true,false,true,false,true],
                        [true,false,true,false,true,false],
                        [false,true,false,true,false,true],
                        [true,false,true,false,true,false]
                    ];
            break;
        case '▓' :
            theLed = [
                        [false,true,true,false,true,true],
                        [true,true,false,true,true,false],
                        [true,false,true,true,false,true],
                        [false,true,true,false,true,true],
                        [true,true,false,true,true,false],
                        [true,false,true,true,false,true],
                        [false,true,true,false,true,true],
                        [true,true,false,true,true,false],
                        [true,false,true,true,false,true],
                        [false,true,true,false,true,true]
                    ];
            break;
        default:
            theLed = [[false, false, false, false, false, false, false, false, false, false]];
    }  
    return theLed;
}