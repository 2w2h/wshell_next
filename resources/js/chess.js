let board = [
    [-2, -3, -4, -5, -6, -4, -3, -2],
    [-1, -1, -1, -1, -1, -1, -1, -1],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [1, 1, 1, 1, 1, 1, 1, 1],
    [2, 3, 4, 5, 6, 4, 3, 2],
];
const PAWN = 1;
const ROOK = 2;
const KNIGHT = 3;
const BISHOP = 4;
const QUEEN = 5;
const KING = 6;

let mask = (condition, type) => {
    return board.map((row, rowIndex) => row.map((ceil, colIndex) => {
        return condition(ceil, rowIndex, colIndex, type);
    }));
};
let or = (masks) => {
    const reducer = (acc, value) => acc || value;
    return masks[0].map((row, rowIndex) => row.map((ceil, colIndex) => {
        return masks.map(x => x[rowIndex][colIndex]).reduce(reducer, false);
    }));
};

let pawnProtected = mask((fig, x, y) => {
    if (!board[x + 1]) return false;
    return board[x + 1][y + 1] === PAWN || board[x + 1][y - 1] === PAWN;
});
let kingProtected = mask((fig, x, y) => {
    let a, b, c;
    a = board[x][y + 1] === KING || board[x][y - 1] === KING;
    if (board[x + 1]) {
        b = board[x + 1][y + 1] === KING || board[x + 1][y] === KING || board[x + 1][y - 1] === KING;
    }
    if (board[x - 1]) {
        c = board[x - 1][y + 1] === KING || board[x - 1][y] === KING || board[x - 1][y - 1] === KING;
    }
    return a || b || c || false;
});
let knightProtected = mask((fig, x, y) => {
    let a, b, c, d;
    if (board[x + 2]) {
        a = board[x + 2][y - 1] === KNIGHT || board[x + 2][y + 1] === KNIGHT;
    }
    if (board[x + 1]) {
        b = board[x + 1][y - 2] === KNIGHT || board[x + 1][y + 2] === KNIGHT;
    }
    if (board[x - 1]) {
        c = board[x - 1][y - 2] === KNIGHT || board[x - 1][y + 2] === KNIGHT;
    }
    if (board[x - 2]) {
        d = board[x - 2][y - 1] === KNIGHT || board[x - 2][y + 1] === KNIGHT;
    }
    return a || b || c || d || false;
});
let lineCondition = (fig, x, y, type) => {
    let a, b, c, d;

    let row = board[x];
    a = row[y - 1] === type;
    a = a || (!row[y - 1] && row[y - 2] === type);
    a = a || (!row[y - 1] && !row[y - 2] && row[y - 3] === type);
    a = a || (!row[y - 1] && !row[y - 2] && !row[y - 3] && row[y - 4] === type);
    a = a || (!row[y - 1] && !row[y - 2] && !row[y - 3] && !row[y - 4] && row[y - 5] === type);
    a = a || (!row[y - 1] && !row[y - 2] && !row[y - 3] && !row[y - 4] && !row[y - 5] && row[y - 6] === type);
    a = a || (!row[y - 1] && !row[y - 2] && !row[y - 3] && !row[y - 4] && !row[y - 5] && !row[y - 6] && row[y - 7] === type);

    b = row[y + 1] === type;
    b = b || (!row[y + 1] && row[y + 2] === type);
    b = b || (!row[y + 1] && !row[y + 2] && row[y + 3] === type);
    b = b || (!row[y + 1] && !row[y + 2] && !row[y + 3] && row[y + 4] === type);
    b = b || (!row[y + 1] && !row[y + 2] && !row[y + 3] && !row[y + 4] && row[y + 5] === type);
    b = b || (!row[y + 1] && !row[y + 2] && !row[y + 3] && !row[y + 4] && !row[y + 5] && row[y + 6] === type);
    b = b || (!row[y + 1] && !row[y + 2] && !row[y + 3] && !row[y + 4] && !row[y + 5] && !row[y + 6] && row[y + 7] === type);

    if (board[x + 1]) c = c || board[x + 1][y] === type;
    if (board[x + 2]) c = c || (!board[x + 1][y] && board[x + 2][y] === type);
    if (board[x + 3]) c = c || (!board[x + 1][y] && !board[x + 2][y] && board[x + 3][y] === type);
    if (board[x + 4]) c = c || (!board[x + 1][y] && !board[x + 2][y] && !board[x + 3][y] && board[x + 4][y] === type);
    if (board[x + 5]) c = c || (!board[x + 1][y] && !board[x + 2][y] && !board[x + 3][y] && !board[x + 4][y] && board[x + 5][y] === type);
    if (board[x + 6]) c = c || (!board[x + 1][y] && !board[x + 2][y] && !board[x + 3][y] && !board[x + 4][y] && !board[x + 5][y] && board[x + 6][y] === type);
    if (board[x + 7]) c = c || (!board[x + 1][y] && !board[x + 2][y] && !board[x + 3][y] && !board[x + 4][y] && !board[x + 5][y] && !board[x + 6][y] && board[x + 7][y] === type);

    if (board[x - 1]) c = c || board[x - 1][y] === type;
    if (board[x - 2]) c = c || (!board[x - 1][y] && board[x - 2][y] === type);
    if (board[x - 3]) c = c || (!board[x - 1][y] && !board[x - 2][y] && board[x - 3][y] === type);
    if (board[x - 4]) c = c || (!board[x - 1][y] && !board[x - 2][y] && !board[x - 3][y] && board[x - 4][y] === type);
    if (board[x - 5]) c = c || (!board[x - 1][y] && !board[x - 2][y] && !board[x - 3][y] && !board[x - 4][y] && board[x - 5][y] === type);
    if (board[x - 6]) c = c || (!board[x - 1][y] && !board[x - 2][y] && !board[x - 3][y] && !board[x - 4][y] && !board[x - 5][y] && board[x - 6][y] === type);
    if (board[x - 7]) c = c || (!board[x - 1][y] && !board[x - 2][y] && !board[x - 3][y] && !board[x - 4][y] && !board[x - 5][y] && !board[x - 6][y] && board[x - 7][y] === type);

    return a || b || c || d || false;
};
let diagonalCondition = (fig, x, y, type) => {
    let a, b, c, d;

    if (board[x + 1]) a = board[x + 1][y + 1] === type;
    if (board[x + 2]) a = a || (!board[x + 1][y + 1] && board[x + 2][y + 2] === type);
    if (board[x + 3]) a = a || (!board[x + 1][y + 1] && !board[x + 2][y + 2] && board[x + 3][y + 3] === type);
    if (board[x + 4]) a = a || (!board[x + 1][y + 1] && !board[x + 2][y + 2] && !board[x + 3][y + 3] && board[x + 4][y + 4] === type);
    if (board[x + 5]) a = a || (!board[x + 1][y + 1] && !board[x + 2][y + 2] && !board[x + 3][y + 3] && !board[x + 4][y + 4] && board[x + 5][y + 5] === type);
    if (board[x + 6]) a = a || (!board[x + 1][y + 1] && !board[x + 2][y + 2] && !board[x + 3][y + 3] && !board[x + 4][y + 4] && !board[x + 5][y + 5] && board[x + 6][y + 6] === type);
    if (board[x + 7]) a = a || (!board[x + 1][y + 1] && !board[x + 2][y + 2] && !board[x + 3][y + 3] && !board[x + 4][y + 4] && !board[x + 5][y + 5] && !board[x + 6][y + 6] && board[x + 7][y + 7] === type);

    if (board[x + 1]) b = board[x + 1][y - 1] === type;
    if (board[x + 2]) b = b || (!board[x + 1][y - 1] && board[x + 2][y - 2] === type);
    if (board[x + 3]) b = b || (!board[x + 1][y - 1] && !board[x + 2][y - 2] && board[x + 3][y - 3] === type);
    if (board[x + 4]) b = b || (!board[x + 1][y - 1] && !board[x + 2][y - 2] && !board[x + 3][y - 3] && board[x + 4][y - 4] === type);
    if (board[x + 5]) b = b || (!board[x + 1][y - 1] && !board[x + 2][y - 2] && !board[x + 3][y - 3] && !board[x + 4][y - 4] && board[x + 5][y - 5] === type);
    if (board[x + 6]) b = b || (!board[x + 1][y - 1] && !board[x + 2][y - 2] && !board[x + 3][y - 3] && !board[x + 4][y - 4] && !board[x + 5][y - 5] && board[x + 6][y - 6] === type);
    if (board[x + 7]) b = b || (!board[x + 1][y - 1] && !board[x + 2][y - 2] && !board[x + 3][y - 3] && !board[x + 4][y - 4] && !board[x + 5][y - 5] && !board[x + 6][y - 6] && board[x + 7][y - 7] === type);

    if (board[x - 1]) c = board[x - 1][y + 1] === type;
    if (board[x - 2]) c = c || (!board[x - 1][y + 1] && board[x - 2][y + 2] === type);
    if (board[x - 3]) c = c || (!board[x - 1][y + 1] && !board[x - 2][y + 2] && board[x - 3][y + 3] === type);
    if (board[x - 4]) c = c || (!board[x - 1][y + 1] && !board[x - 2][y + 2] && !board[x - 3][y + 3] && board[x - 4][y + 4] === type);
    if (board[x - 5]) c = c || (!board[x - 1][y + 1] && !board[x - 2][y + 2] && !board[x - 3][y + 3] && !board[x - 4][y + 4] && board[x - 5][y + 5] === type);
    if (board[x - 6]) c = c || (!board[x - 1][y + 1] && !board[x - 2][y + 2] && !board[x - 3][y + 3] && !board[x - 4][y + 4] && !board[x - 5][y + 5] && board[x - 6][y + 6] === type);
    if (board[x - 7]) c = c || (!board[x - 1][y + 1] && !board[x - 2][y + 2] && !board[x - 3][y + 3] && !board[x - 4][y + 4] && !board[x - 5][y + 5] && !board[x - 6][y + 6] && board[x - 7][y + 7] === type);

    if (board[x - 1]) d = board[x - 1][y - 1] === type;
    if (board[x - 2]) d = d || (!board[x - 1][y - 1] && board[x - 2][y - 2] === type);
    if (board[x - 3]) d = d || (!board[x - 1][y - 1] && !board[x - 2][y - 2] && board[x - 3][y - 3] === type);
    if (board[x - 4]) d = d || (!board[x - 1][y - 1] && !board[x - 2][y - 2] && !board[x - 3][y - 3] && board[x - 4][y - 4] === type);
    if (board[x - 5]) d = d || (!board[x - 1][y - 1] && !board[x - 2][y - 2] && !board[x - 3][y - 3] && !board[x - 4][y - 4] && board[x - 5][y - 5] === type);
    if (board[x - 6]) d = d || (!board[x - 1][y - 1] && !board[x - 2][y - 2] && !board[x - 3][y - 3] && !board[x - 4][y - 4] && !board[x - 5][y - 5] && board[x - 6][y - 6] === type);
    if (board[x - 7]) d = d || (!board[x - 1][y - 1] && !board[x - 2][y - 2] && !board[x - 3][y - 3] && !board[x - 4][y - 4] && !board[x - 5][y - 5] && !board[x - 6][y - 6] && board[x - 7][y - 7] === type);

    return a || b || c || d || false;
};

let rookProtected = mask(lineCondition, ROOK);
let bishopProtected = mask(diagonalCondition, BISHOP);
let queenProtected = or([
    mask(lineCondition, QUEEN),
    mask(diagonalCondition, QUEEN)
]);

let anyProtected = or([
    pawnProtected,
    kingProtected,
    knightProtected,
    rookProtected,
    bishopProtected,
    queenProtected,
]);

console.log(anyProtected);

// АЛГОРИТМ
// защищать незащищенное
// есть незащищенное
// нападать на незащищенное (создавать угрозу)
// случайный ход, улучшающий позицию
