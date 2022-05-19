const start = document.querySelector('#start');
start.addEventListener('click', startGame);

const newGame = document.querySelector('#theEnd');
newGame.addEventListener("click", goNewGame);

const divGame = document.querySelector('#game');
const blocks = divGame.querySelectorAll('td');
const timer = divGame.querySelector('#timer');

const active = 'active';
const setDefaultColor = (elem) => elem.style.background = 'white';
const setNewGameColor = (elem) => elem.style.background = '#ddd';
const colors = fillArray();
let obj = createObj();
let arrTd = [];
let countMove = 0;

// functions
const clearArray = () => [];
const disable = (elem) => elem.disabled = true;
const activate = (elem) => elem.classList.add(active);
const deactivate = (elem) => elem.classList.remove(active);
const isActive = (elem) => elem.classList.contains(active);
const initBlocks = (clickMode) => {
    for (let block of blocks) {
        activate(block);
        block.addEventListener('click', clickMode);
    }
}
const reInitBlock = (clickMode) => {
    for (let block of blocks) {
        if (!isActive(block)) {
            block.removeEventListener('click', clickMode);
        }
    }
}
const colorBack = (elem) => elem.style.background;
const Win = () => !divGame.querySelectorAll('.active').length;

function startGame() {
    disable(start);
    timerGame();
    initBlocks(clickMode);

    function clickMode() {
        countMove++;
        this.style.background = obj[this.innerHTML];
        arrTd.push(this);
        correctClicks(arrTd);

        if (arrTd.length === 2) {
            colorBack(arrTd[0]) === colorBack(arrTd[1]) ? getMatch() : notMatch();
        }
    }

    function getMatch() {
        deactivate(arrTd[0]);
        deactivate(arrTd[1]);
        arrTd = clearArray();
        reInitBlock(clickMode);
    }

    function notMatch() {
        for (let td of blocks) {
            td.removeEventListener('click', clickMode);
        }

        const id = setTimeout(function() {
            setDefaultColor(arrTd[0]);
            setDefaultColor(arrTd[1]);
            arrTd = clearArray();

            for (let td of blocks) {
                if (td.classList.contains('active')) {
                    td.addEventListener('click', clickMode);
                }
            }

            clearTimeout(id);
        }, 300);
    }

    function correctClicks(blocks) {
        if (blocks[0] === blocks[1]) {
            blocks.splice(1);
        }

        if (blocks.length > 2) {
            blocks.splice(2);
        }
    }

    function timerGame() {
        timer.innerHTML = "00:00:000";

        let millisec = 0;
        let seconds = 0;
        let minutes = 0;
        let time = new Date().getTime();

        const id = setInterval(function() {
            millisec = new Date().getTime() - time;

            if (millisec > 999) {
                time = new Date().getTime();
                seconds++;
            }

            if (seconds > 59) {
                seconds = 0;
                minutes++;
            }

            if (Win()) {
                clearInterval(id);
                modalWindow();
            }

            timer.innerHTML = `${getZero(minutes)}:${getZero(seconds)}.${millisec}`;
        }, 1);
    }

    const getZero = (num) => num < 10 ? `0${num}` : num;

    function modalWindow() {
        document.querySelector('#winner').style.display = 'grid';
        document.querySelector('#yourTime').innerHTML = `${countMove} ходов`;
    }
}

function goNewGame() {
    countMove = 0;
    obj = createObj();
    timer.innerHTML = "00:00.000";
    document.querySelector('#winner').style.display = 'none';
    start.disabled = false;

    for (let block of blocks) {
        setNewGameColor(block);
    }
}

function fillArray() {
    return [
        '1',
        'red',
        'red',
        'green',
        'green',
        'blue',
        'blue',
        'black',
        'black',
        'yellow',
        'yellow',
        'hotpink',
        'hotpink',
        'indigo',
        'indigo',
        'magenta',
        'magenta',
    ];
}

function createObj() {
    const obj = {};
    const set = new Set();

    while (set.size !== 16) {
        set.add(Math.ceil(Math.random() * 16));
    }

    newObj(set, obj);

    return obj;
}

function newObj(arr, obj) {
    let i = 0;

    arr.forEach((elem) => {
        i++;
        obj[i] = colors[elem];
    })
}
