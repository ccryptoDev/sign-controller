function charToLED(theChar, height = 10, width = 4){
    var theLed = [];

    // Helper function to scale a pattern to the desired dimensions
    function scalePattern(pattern, targetHeight, targetWidth) {
        const originalHeight = pattern.length;
        const originalWidth = pattern[0].length;

        // 10x6 = Original, return directly
        if (targetHeight === 10 && targetWidth === 6) {
            return pattern;
        }

        // Handpicked rows and columns for better clarity in small sizes
        const smallSizeMap = {
            "8x5": {
                rows: [0, 1, 3, 4, 5, 6, 8, 9],   // select visually meaningful rows
                cols: [0, 1, 2, 4, 5]            // sample more columns than 8x4
            },
            "8x4": {
                rows: [0, 1, 3, 4, 5, 6, 8, 9],
                cols: [0, 2, 3, 5]
            },
            "7x4": {
                rows: [0, 2, 4, 5, 6, 7, 9],
                cols: [0, 2, 3, 5]
            }
        };

        const key = `${targetHeight}x${targetWidth}`;
        // Character-specific override for small size
        // if (key === '8x5') {
        //     if (theChar === 'g') {
        //         return [
        //             [false, false, false,  false,  false],
        //             [false, false,  false, false, false ],
        //             [true, true,  true, true, true],
        //             [true, false, false,  false,  true ],
        //             [true, true, false, true, true ],
        //             [false, true,  true, true, true ],
        //             [true, false,  false,  true,  true],
        //             [true, true, true, true, false],
        //         ];
        //     }

        //     // Add more overrides here
        //     if (theChar === '%') {
        //         return [
        //             [true, false, false, false, true ],
        //             [false, false, false, true, false],
        //             [false, false, true, false, false],
        //             [false, true, false, false, false],
        //             [false, false, true, false, false],
        //             [false, true, false, false, false],
        //             [true, false, false, false, true ],
        //             [false, false, false, false, false],
        //         ];
        //     }
        // }
        if (smallSizeMap[key]) {
            const { rows, cols } = smallSizeMap[key];
            const scaledPattern = [];

            for (let i = 0; i < targetHeight; i++) {
                const originalRow = pattern[rows[i]];
                const row = [];

                for (let j = 0; j < targetWidth; j++) {
                    row.push(originalRow[cols[j]]);
                }

                scaledPattern.push(row);
            }

            return scaledPattern;
        }

        // General downscale logic for other sizes
        const scaleY = originalHeight / targetHeight;
        const scaleX = originalWidth / targetWidth;
        const scaledPattern = [];

        for (let y = 0; y < targetHeight; y++) {
            const row = [];
            const startY = Math.floor(y * scaleY);
            const endY = Math.min(Math.ceil((y + 1) * scaleY), originalHeight);

            for (let x = 0; x < targetWidth; x++) {
                const startX = Math.floor(x * scaleX);
                const endX = Math.min(Math.ceil((x + 1) * scaleX), originalWidth);

                let onCount = 0;
                let totalCount = 0;

                for (let oy = startY; oy < endY; oy++) {
                    for (let ox = startX; ox < endX; ox++) {
                        totalCount++;
                        if (pattern[oy][ox]) onCount++;
                    }
                }

                row.push(onCount >= totalCount / 2);
            }

            scaledPattern.push(row);
        }

        return scaledPattern;
    }

    // function scalePattern(pattern, targetHeight, targetWidth) {
    //     const originalHeight = pattern.length;
    //     const originalWidth = pattern[0].length;

    //     // 10x6 = Original, return directly
    //     if (targetHeight === 10 && targetWidth === 6) {
    //         return pattern;
    //     }

    //     // Handpicked rows and columns for better clarity in small sizes
    //     const smallSizeMap = {
    //         "8x4": {
    //             rows: [0, 1, 3, 4, 5, 6, 8, 9], // select best rows for readability
    //             cols: [0, 2, 3, 5]              // sample columns evenly and keep symmetry
    //         },
    //         "7x4": {
    //             rows: [0, 2, 4, 5, 6, 7, 9],
    //             cols: [0, 2, 3, 5]
    //         }
    //     };

    //     const key = `${targetHeight}x${targetWidth}`;
    //     if (smallSizeMap[key]) {
    //         const { rows, cols } = smallSizeMap[key];
    //         const scaledPattern = [];

    //         for (let i = 0; i < targetHeight; i++) {
    //             const originalRow = pattern[rows[i]];
    //             const row = [];

    //             for (let j = 0; j < targetWidth; j++) {
    //                 row.push(originalRow[cols[j]]);
    //             }

    //             scaledPattern.push(row);
    //         }

    //         return scaledPattern;
    //     }

    //     // General downscale logic for other sizes
    //     const scaleY = originalHeight / targetHeight;
    //     const scaleX = originalWidth / targetWidth;
    //     const scaledPattern = [];

    //     for (let y = 0; y < targetHeight; y++) {
    //         const row = [];
    //         const startY = Math.floor(y * scaleY);
    //         const endY = Math.min(Math.ceil((y + 1) * scaleY), originalHeight);

    //         for (let x = 0; x < targetWidth; x++) {
    //             const startX = Math.floor(x * scaleX);
    //             const endX = Math.min(Math.ceil((x + 1) * scaleX), originalWidth);

    //             let onCount = 0;
    //             let totalCount = 0;

    //             for (let oy = startY; oy < endY; oy++) {
    //                 for (let ox = startX; ox < endX; ox++) {
    //                     totalCount++;
    //                     if (pattern[oy][ox]) onCount++;
    //                 }
    //             }

    //             row.push(onCount >= totalCount / 2);
    //         }

    //         scaledPattern.push(row);
    //     }

    //     return scaledPattern;
    // }

    // Define the base patterns (original 10x6 patterns)
    let basePattern;

    if (height === 7 && width === 4) {
        switch(theChar) {
            case 'A':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'B':
                basePattern = [
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, false]
                ];
                break;
            case 'C':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'D':
                basePattern = [
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, false]
                ];
                break;
            case 'E':
                basePattern = [
                    [true, true, true, true],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, true, true, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, true, true, true]
                ];
                break;
            case 'F':
                basePattern = [
                    [true, true, true, true],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, true, true, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, false]
                ];
                break;
            case 'G':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, false],
                    [true, false, true, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'H':
                basePattern = [
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'I':
                basePattern = [
                    [true, true, true, true],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [true, true, true, true]
                ];
                break;
            case 'J':
                basePattern = [
                    [false, false, true, true],
                    [false, false, false, true],
                    [false, false, false, true],
                    [false, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'K':
                basePattern = [
                    [true, false, false, true],
                    [true, false, true, false],
                    [true, true, false, false],
                    [true, true, false, false],
                    [true, false, true, false],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'L':
                basePattern = [
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, true, true, true]
                ];
                break;
            case 'M':
                basePattern = [
                    [true, false, false, true],
                    [true, true, true, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'N':
                basePattern = [
                    [true, false, false, true],
                    [true, true, false, true],
                    [true, true, false, true],
                    [true, false, true, true],
                    [true, false, true, true],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'O':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'P':
                basePattern = [
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, false]
                ];
                break;
            case 'Q':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, true, true],
                    [true, false, false, true],
                    [false, true, true, true]
                ];
                break;
            case 'R':
                basePattern = [
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, false],
                    [true, false, true, false],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'S':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [false, true, true, false],
                    [false, false, false, true],
                    [false, false, false, true],
                    [true, true, true, false]
                ];
                break;
            case 'T':
                basePattern = [
                    [true, true, true, true],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false]
                ];
                break;
            case 'U':
                basePattern = [
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'V':
                basePattern = [
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false],
                    [false, true, true, false]
                ];
                break;
            case 'W':
                basePattern = [
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, true],
                    [true, true, true, true],
                    [true, false, false, true]
                ];
                break;
            case 'X':
                basePattern = [
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'Y':
                basePattern = [
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false]
                ];
                break;
            case 'Z':
                basePattern = [
                    [true, true, true, true],
                    [false, false, false, true],
                    [false, false, true, false],
                    [false, true, false, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, true, true, true]
                ];
                break;
            // Add lowercase letters
            case 'a':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, true, true, true],
                    [true, false, false, true],
                    [false, true, true, true]
                ];
                break;
            case 'b':
                basePattern = [
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, true, true, false]
                ];
                break;
            case 'c':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, false],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'd':
                basePattern = [
                    [false, false, false, true],
                    [false, false, false, true],
                    [false, true, true, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, true]
                ];
                break;
            case 'e':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, true, true, true],
                    [true, false, false, false],
                    [false, true, true, true]
                ];
                break;
            case 'f':
                basePattern = [
                    [false, false, true, true],
                    [false, true, false, false],
                    [true, true, true, true],
                    [false, true, false, false],
                    [false, true, false, false],
                    [false, true, false, false],
                    [false, true, false, false]
                ];
                break;
            case 'g':
                basePattern = [
                    [false, false, false, false],
                    [false, true, true, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, true],
                    [false, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'h':
                basePattern = [
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'i':
                basePattern = [
                    [false, true, true, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false]
                ];
                break;
            case 'j':
                basePattern = [
                    [false, false, true, false],
                    [false, false, false, false],
                    [false, false, true, false],
                    [false, false, true, false],
                    [false, false, true, false],
                    [true, false, true, false],
                    [false, true, false, false]
                ];
                break;
            case 'k':
                basePattern = [
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, true],
                    [true, false, true, false],
                    [true, true, false, false],
                    [true, false, true, false],
                    [true, false, false, true]
                ];
                break;
            case 'l':
                basePattern = [
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, true]
                ];
                break;
            case 'm':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, true, true, true],
                    [true, false, true, true],
                    [true, false, true, true],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'n':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true]
                ];
                break;
            case 'o':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'p':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, true, true, false],
                    [true, false, false, false],
                    [true, false, false, false]
                ];
                break;
            case 'q':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, true],
                    [true, false, false, true],
                    [false, true, true, true],
                    [false, false, false, true],
                    [false, false, false, true]
                ];
                break;
            case 'r':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, false, true, true],
                    [true, true, false, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, false, false, false]
                ];
                break;
            case 's':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [true, false, false, false],
                    [false, true, true, false],
                    [false, false, false, true],
                    [true, true, true, false]
                ];
                break;
            case 't':
                basePattern = [
                    [false, true, false, false],
                    [false, true, false, false],
                    [true, true, true, false],
                    [false, true, false, false],
                    [false, true, false, false],
                    [false, true, false, true],
                    [false, false, true, false]
                ];
                break;
            case 'u':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, true]
                ];
                break;
            case 'v':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false],
                    [false, true, true, false]
                ];
                break;
            case 'w':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, true, true],
                    [true, true, true, true],
                    [true, false, false, true]
                ];
                break;
            case 'x':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, false, false, true],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [true, false, false, true]
                ];
                break;
            case 'y':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, true],
                    [false, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case 'z':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, true, true, true],
                    [false, false, true, false],
                    [false, true, false, false],
                    [true, false, false, false],
                    [true, true, true, true]
                ];
                break;
            // Numbers
            case '0':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case '1':
                basePattern = [
                    [false, true, true, false],
                    [false, false, true, false],
                    [false, false, true, false],
                    [false, false, true, false],
                    [false, false, true, false],
                    [false, false, true, false],
                    [false, true, true, true]
                ];
                break;
            case '2':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [false, false, false, true],
                    [false, false, true, false],
                    [false, true, false, false],
                    [true, false, false, false],
                    [true, true, true, true]
                ];
                break;
            case '3':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [false, false, false, true],
                    [false, true, true, false],
                    [false, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case '4':
                basePattern = [
                    [false, false, true, false],
                    [false, true, true, false],
                    [true, false, true, false],
                    [true, false, true, false],
                    [true, true, true, true],
                    [false, false, true, false],
                    [false, false, true, false]
                ];
                break;
            case '5':
                basePattern = [
                    [true, true, true, true],
                    [true, false, false, false],
                    [true, true, true, false],
                    [false, false, false, true],
                    [false, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case '6':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, false],
                    [true, false, false, false],
                    [true, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case '7':
                basePattern = [
                    [true, true, true, true],
                    [false, false, false, true],
                    [false, false, true, false],
                    [false, true, false, false],
                    [false, true, false, false],
                    [false, true, false, false],
                    [false, true, false, false]
                ];
                break;
            case '8':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, false]
                ];
                break;
            case '9':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [true, false, false, true],
                    [false, true, true, true],
                    [false, false, false, true],
                    [false, false, false, true],
                    [false, true, true, false]
                ];
                break;
            // Common symbols
            case ' ':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false]
                ];
                break;
            case '.':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false]
                ];
                break;
            case ',':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [false, false, true, false]
                ];
                break;
            case '!':
                basePattern = [
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, false, false, false],
                    [false, true, true, false]
                ];
                break;
            case '?':
                basePattern = [
                    [false, true, true, false],
                    [true, false, false, true],
                    [false, false, true, false],
                    [false, true, false, false],
                    [false, true, false, false],
                    [false, false, false, false],
                    [false, true, false, false]
                ];
                break;
            case ':':
                basePattern = [
                    [false, false, false, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [false, true, true, false]
                ];
                break;
            case ';':
                basePattern = [
                    [false, false, false, false],
                    [false, true, true, false],
                    [false, true, true, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, true, false],
                    [false, false, true, false]
                ];
                break;
            case '+':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, true, false, false],
                    [true, true, true, true],
                    [false, true, false, false],
                    [false, false, false, false],
                    [false, false, false, false]
                ];
                break;
            case '-':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, true, true, true],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false]
                ];
                break;
            case '*':
                basePattern = [
                    [false, false, false, false],
                    [true, false, false, true],
                    [false, true, true, false],
                    [true, true, true, true],
                    [false, true, true, false],
                    [true, false, false, true],
                    [false, false, false, false]
                ];
                break;
            case '/':
                basePattern = [
                    [false, false, false, true],
                    [false, false, true, false],
                    [false, false, true, false],
                    [false, true, false, false],
                    [false, true, false, false],
                    [true, false, false, false],
                    [true, false, false, false]
                ];
                break;
            case '\\':
                basePattern = [
                    [true, false, false, false],
                    [false, true, false, false],
                    [false, true, false, false],
                    [false, false, true, false],
                    [false, false, true, false],
                    [false, false, false, true],
                    [false, false, false, true]
                ];
                break;
            case '=':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, true, true, true],
                    [false, false, false, false],
                    [true, true, true, true],
                    [false, false, false, false],
                    [false, false, false, false]
                ];
                break;
            case '_':
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [true, true, true, true]
                ];
                break;
            default:
                basePattern = [
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false],
                    [false, false, false, false]
                ];
        }
    } else {
        switch(theChar) {
            case 'A' :
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
                    [true,true,true,true,true,true],
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
                    [false,false,false,false,false,false],
                    [false,false,false,false,false,false],
                    [false,false,false,false,false,false],
                    [false,false,false,false,false,false],
                    [false,true,true,true,false,true],
                    [true,true,false,false,true,true],
                    [true,false,false,false,false,true],
                    [true,false,false,false,false,true],
                    [true,true,false,false,true,true],
                    [false,true,true,true,false,true]
                ];
                break;
            case 'b' :
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
                    [false,false,false,false,false,false],
                    [false,false,false,false,false,false],
                    [false,false,false,false,false,false],
                    [false,false,false,false,false,false],
                    [false,true,false,false,true,false],
                    [true,true,true,true,true,true],
                    [true,false,true,true,false,true],
                    [true,false,true,true,false,true],
                    [true,false,false,false,false,true],
                    [true,false,false,false,false,true]
                ];
                break;
            case 'n' :
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [[false, false, true, false, false, true, false],
                        [false, false, true, false, true, false, true],
                        [false, false, true, false, true, false, true],
                        [false, true, false, true, true, true, true],
                        [true, false, false, false, false, false, false]];
                break;
            case 'é' :
                basePattern = [[false, false, false, true, true, true, false],
                        [false, false, true, false, true, false, true],
                        [false, false, true, false, true, false, true],
                        [false, true, false, true, true, false, true],
                        [true, false, false, false, false, false, false]];
                break;
            case 'í' :
                basePattern = [[false, false, false, false, false, false, false],
                        [false, true, false, false, false, false, false],
                        [true, false, true, true, true, true, true],
                        [false, false, false, false, false, false, false],
                        [false, false, false, false, false, false, false]];
                break;
            case 'ó' :
                basePattern = [[false, false, false, true, true, true, false],
                        [false, false, true, false, false, false, true],
                        [false, false, true, false, false, false, true],
                        [false, true, false, true, true, true, false],
                        [true, false, false, false, false, false, false]];
                break;
            case 'ú' :
                basePattern = [[false, false, true, true, true, true, false],
                        [false, false, false, false, false, false, true],
                        [false, true, false, false, false, false, true],
                        [true, false, true, true, true, true, true],
                        [false, false, false, false, false, false, false]];
                break;
            case '/' :
                basePattern = [
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
                basePattern = [
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
                basePattern = [[false, false, false, false, false, false, false],
                        [false, false, false, false, false, false, false],
                        [true, true, true, true, true, true, true],
                        [false, false, false, false, false, false, false],
                        [false, false, false, false, false, false, false]];
                break;
            case '=' :
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [[false, false, true, false, false, false, false],
                        [false, true, false, false, false, false, false],
                        [true, false, false, false, false, false, false],
                        [false, false, false, false, false, false, false],
                        [false, false, false, false, false, false, false]];
                break;
            case "'" :
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
            case ':' :
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
            case '1' :
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
            case ' ' :
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
                basePattern = [
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
        }
    }
    return basePattern;
    // Scale the pattern to the desired dimensions
    theLed = scalePattern(basePattern, height, width);

    return theLed;
}
