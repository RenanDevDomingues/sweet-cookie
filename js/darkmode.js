addEventListener('DOMContentLoaded', function() {
    let darkmode = false;
    document.querySelector('.darkmode').addEventListener('click', darkmodechange);
    darkmodeonload();
})

function applydarkmode(darkmode) {
    if (darkmode) {
        document.querySelector('.darkmode-toggle').style.transform = 'translateX(80px)';
        document.querySelector('.darkmode-toggle').id='dark-toggle';
        document.querySelector('.darkmode').id='dark-mode';
        document.body.style.backgroundColor = '#2F3233';
        document.body.style.color = "white";
    } else {
        document.querySelector('.darkmode-toggle').style.transform = 'translateX(4px)';
        document.querySelector('.darkmode-toggle').id='';
        document.querySelector('.darkmode').id='';
        document.body.style.backgroundColor = '#FFF1E1';
        document.body.style.color = "black";
    }
}

function darkmodechange() {
    darkmode = !darkmode;
    applydarkmode(darkmode);
    localStorage.setItem('savestate', darkmode);
}

function darkmodeonload() {
    if (localStorage.getItem('savestate') === 'true') {
        darkmode = true;
        applydarkmode(darkmode);
    } else {
        darkmode = false;
        applydarkmode(darkmode);
    }
}