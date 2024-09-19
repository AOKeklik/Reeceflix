<?php require_once("./includes/header.php")?>

<main class="bg-gray-700 minh-100vh">

    <section class="py-10">
            <div class="container text-white">
                <label class="form-label" role="search">
                    <input id="js-search-input" type="text">
                    <i class="bi bi-search text-3"></i>
                    <span>Search something</span>
                </label>
            </div>
    </section>

    <section id="js-search-results">

    </section>

</main>

<script>

new class Form {
    form = document.querySelectorAll(".form")
    inputs = document.querySelectorAll(".form-label input")

	constructor() {
		this._handlerFocus ()
		this._handlerFocusOut ()
	}

	_handlerFocus (e) {
		this.inputs.forEach(el => {
			el.addEventListener("focus", e => {
                this._moveTop(e)
            })
		})
	}

    _handlerFocusOut (e) {
		this.inputs.forEach(el => {
			el.addEventListener("focusout", e => {
                this._moveTop(e)
            })
		})
	}

    _moveTop (e) {
        const theNode = e.target
		const theValue = e.target.value.trim()
		const thePlaceholder = theNode.parentElement.querySelector("span")
		const theIcon = theNode.parentElement.querySelector("i")
		const theType = e.type

		if (theType === "focus") {
			thePlaceholder.style.transform = "translateY(-5rem) scale(.9)"
			theIcon.style.color = "var(--clr-red-500)"
			return
		}

		if (theType === "focusout" && theValue != "") return

		thePlaceholder.style = null
		theIcon.style = null
    }
}

new class SearchForm {
    input = document.getElementById ("js-search-input")
    results = document.getElementById ("js-search-results")
    constructor () {
        this._handlerKeyup () 
    }
    _handlerKeyup () {
        this.input.addEventListener ("keyup", e => {
            clearTimeout (window.timer)
            
            window.timer = setTimeout ( async () =>  {
                try {
                    const vals = e.target.value

                    const res = await fetch(ROOT_DIR + "core/ajax/search.php", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            username: USER_MAIL,
                            vals                            
                        })
                    })
                    if (!res.ok) throw new Error('Network response was not ok ' + res.statusText)
                    const data = await res.text()    
                    this.results.innerHTML = data
                    console.log('Success:', data)           
                }  catch (err) {
                    console.error('Error:', err)
                }      
            }, 500)
            
        })
    }
}

</script>

<?php require_once("./includes/footer.php")?>