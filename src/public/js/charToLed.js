function charToLED(theChar, height = 10, width = 4){
    var theLed = [];

    // Helper function to scale a pattern to the desired dimensions
    function scalePattern(pattern, targetHeight, targetWidth) {
        const originalHeight = pattern.length;
        const originalWidth = pattern[0].length;

        // Special case handling for common dimensions
        if (targetHeight === 8 && targetWidth === 6) {
            // Special case for 8x6 - use specific rows and columns that best represent the character
            const scaledPattern = [];

            // Define which rows from the original pattern to use for height 8
            // Make sure to include the bottom row for characters like "5"
            const rowIndices = [0, 1, 2, 3, 4, 5, 6, 9];

            // Create the scaled pattern
            for (let i = 0; i < targetHeight; i++) {
                const row = [];
                const originalRow = pattern[rowIndices[i]];

                // For width 6, we'll use a more precise mapping
                for (let x = 0; x < targetWidth; x++) {
                    // Map the target column to the original pattern
                    // For width 6, we want to preserve the most important parts of the character
                    let originalX;

                    if (x === 0) originalX = 0; // Left edge
                    else if (x === 1) originalX = 1; // Left inner
                    else if (x === 2) originalX = 2; // Left center
                    else if (x === 3) originalX = 3; // Right center
                    else if (x === 4) originalX = 4; // Right inner
                    else if (x === 5) originalX = 5; // Right edge

                    row.push(originalRow[originalX]);
                }

                scaledPattern.push(row);
            }

            return scaledPattern;
        }
        // Special case for 8x4 dimensions
        else if (targetHeight === 8 && targetWidth === 4) {
            // Special case for 8x4 - use specific rows and columns that best represent the character
            const scaledPattern = [];

            // Define which rows from the original pattern to use for height 8
            // Make sure to include the bottom row for characters like "5"
            const rowIndices = [0, 1, 2, 3, 4, 5, 6, 9];

            // Create the scaled pattern
            for (let i = 0; i < targetHeight; i++) {
                const row = [];
                const originalRow = pattern[rowIndices[i]];

                // For width 4, we'll use a more precise mapping
                for (let x = 0; x < targetWidth; x++) {
                    // Map the target column to the original pattern
                    // For width 4, we want to preserve the most important parts of the character
                    let originalX;

                    if (x === 0) originalX = 0; // Left edge
                    else if (x === 1) originalX = 2; // Left center
                    else if (x === 2) originalX = 3; // Right center
                    else if (x === 3) originalX = 5; // Right edge

                    row.push(originalRow[originalX]);
                }

                scaledPattern.push(row);
            }

            return scaledPattern;
        }
        // For very small heights, we need special handling
        else if (targetHeight < 8) {
            // For small heights, we'll use a more intelligent scaling approach
            const scaledPattern = [];

            // Calculate which rows from the original pattern to use
            const rowIndices = [];
            for (let i = 0; i < targetHeight; i++) {
                // Map the target row to the original pattern
                // For small heights, we want to preserve the most important parts of the character
                if (targetHeight === 7) {
                    // Special case for height 7 - use specific rows that best represent the character
                    if (i === 0) rowIndices.push(0); // Top
                    else if (i === 1) rowIndices.push(1); // Upper middle
                    else if (i === 2) rowIndices.push(2); // Middle upper
                    else if (i === 3) rowIndices.push(4); // Center
                    else if (i === 4) rowIndices.push(5); // Middle lower
                    else if (i === 5) rowIndices.push(7); // Lower middle
                    else if (i === 6) rowIndices.push(9); // Bottom
                } else {
                    // For other small heights, use a more general approach
                    const ratio = i / (targetHeight - 1);
                    const originalIndex = Math.floor(ratio * (originalHeight - 1));
                    rowIndices.push(originalIndex);
                }
            }

            // Now scale each selected row to the target width
            for (let i = 0; i < targetHeight; i++) {
                const row = [];
                const originalRow = pattern[rowIndices[i]];

                for (let x = 0; x < targetWidth; x++) {
                    const ratio = x / (targetWidth - 1);
                    const originalX = Math.floor(ratio * (originalWidth - 1));
                    row.push(originalRow[originalX]);
                }

                scaledPattern.push(row);
            }

            return scaledPattern;
        } else {
            // For larger heights, use an improved scaling approach that ensures complete characters
            const scaledPattern = [];

            // Calculate the scaling factors
            const scaleY = originalHeight / targetHeight;
            const scaleX = originalWidth / targetWidth;

            // Create the scaled pattern
            for (let y = 0; y < targetHeight; y++) {
                const row = [];

                // Calculate the range of original rows that contribute to this target row
                // Special handling for the last row to ensure it's drawn properly
                let originalYStart, originalYEnd;

                if (y === targetHeight - 1) {
                    // For the last row, make sure to include the bottom row of the original pattern
                    originalYStart = Math.floor(y * scaleY);
                    originalYEnd = originalHeight; // Include all remaining rows
                } else {
                    originalYStart = Math.floor(y * scaleY);
                    originalYEnd = Math.min(Math.ceil((y + 1) * scaleY), originalHeight);
                }

                for (let x = 0; x < targetWidth; x++) {
                    // Calculate the range of original columns that contribute to this target column
                    const originalXStart = Math.floor(x * scaleX);
                    const originalXEnd = Math.min(Math.ceil((x + 1) * scaleX), originalWidth);

                    // Determine if this pixel should be on or off based on the majority of pixels in the original area
                    let pixelCount = 0;
                    let onCount = 0;

                    for (let oy = originalYStart; oy < originalYEnd; oy++) {
                        for (let ox = originalXStart; ox < originalXEnd; ox++) {
                            pixelCount++;
                            if (pattern[oy][ox]) {
                                onCount++;
                            }
                        }
                    }

                    // If more than 50% of the pixels in the original area are on, this pixel should be on
                    row.push(onCount > pixelCount / 2);
                }

                scaledPattern.push(row);
            }

            return scaledPattern;
        }
    }

    // Define the base patterns (original 10x6 patterns)
    let basePattern;

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
                [true,false,false,false,false,true],
                [true,true,false,false,true,true],
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

    // Scale the pattern to the desired dimensions
    theLed = scalePattern(basePattern, height, width);

    return theLed;
}
