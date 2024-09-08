export default class Notification {
    constructor(msg) {
        this.message = msg;
        this._notification();
    }

    set message(msg) {
        this._msg = msg;
    }

    get message() {
        return this._msg;
    }

    _notification() {
        const div = document.createElement("div");
        div.innerHTML = `
            <p class='bg-red-400 text-red-900 py-2 px-4 fixed b-2 r-2 flex align-center gap-2 an-fade-to-right'>
                ${this._msg}
                <i class='bi bi-bug-fill text-2'></i>
            </p>
        `;
        document.body.appendChild(div.firstElementChild);
        
        setTimeout(() => {
            div.firstElementChild.remove();
        }, 3000);
    }
}


