class NavHandler {
    _handlerToggleMenu (e) {
        const openIcon = e.target.closest("#nav-bottom-open")
        const closeIcon = e.target.closest("#nav-bottom-close")

        if (openIcon) this._body.classList.add("nav-toggle")
        if (closeIcon) this._body.classList.remove("nav-toggle")
    }
    _handlerHoverNavTopIcon (e) {
        const theNode = e.target.closest(".nav-top-icon")
        if (!theNode) return
        const theFillIcon = theNode.firstElementChild
        const theLineIcon = theNode.lastElementChild

        if (e.type === "mouseenter") {
            theFillIcon.style.opacity = 0
            theLineIcon.style.opacity = 1
        }

         if (e.type === "mouseleave") {
             theFillIcon.style.opacity = 1
             theLineIcon.style.opacity = 0
         }
    }
    _handlerScrollStickyNavBottom (e, that) {
        const top = that._navBottom.offsetTop
        const height = that._navBottom.offsetHeight

        if (window.pageYOffset > top + height) {
            that._navBottom.style = "position: fixed;top: 0;left: 0;z-index: 9;padding: 0 2rem;"
            that._navBottomLogo.style = "max-width: 15rem;margin-top: unset;"
            return
        } 

        that._navBottom.style = null
        that._navBottomLogo.style = null
    }
    _handlerScrollVisibleNavBottom(e, that) {
        const scrollPosition = window.pageYOffset

        if (that._isInViewport(that._nav)) {
            that._navBottom.style = null
            return 
        }

        if (that._prevScrollPosition > scrollPosition) {
            if (
                !document.querySelector("li.open") &&
                !that._body.classList.contains("nav-toggle")
            )
                that._navBottom.style.top = "-6rem"
        } else {
            if (!document.querySelector("li.open"))
                that._navBottom.style.top = "0px"
        }
                
        that._prevScrollPosition = scrollPosition
    }

    _isInViewport (targetElement) {
        const r = targetElement.getBoundingClientRect()
        const top = r.top
        const bottom = r.bottom

        return top < 0 && bottom > 0
    }
}
class NavDisplay extends NavHandler {
    _navDisplay () {
        this._nav.addEventListener("click", this._handlerToggleMenu.bind(this))
    }
    _navTopDisplay () {
        if (!this._navTop) return
        const icons = this._navTop.querySelectorAll("i")
        icons.forEach (icon => {
            const href = icon.getAttribute("data-href") ?? "/Reeceflix/"
            const iconWrapper = document.createElement("a")
            iconWrapper.href = href
            iconWrapper.className = "nav-top-icon"
            iconWrapper.appendChild(icon)
            this._navTop.appendChild(iconWrapper)

            const iconLine = document.createElement("i")
            const newClassName = icon.className.replace(/fill/g, "line")
            iconLine.className = newClassName
            iconWrapper.appendChild(iconLine)
        })
        this._navTop.addEventListener("mouseenter", this._handlerHoverNavTopIcon, true)
        this._navTop.addEventListener("mouseleave", this._handlerHoverNavTopIcon, true)
    }
    _navBottomDisplay () {
        window.addEventListener("scroll", (e) => {
            this._handlerScrollStickyNavBottom (e, this)
            this._handlerScrollVisibleNavBottom (e, this)
        })
        for (const item of this._navBottomMenu.children) {
            const link = item.children[0]
            // link.addEventListener("click", (e) => e.preventDefault())
        }
    }
}
export default class Nav extends NavDisplay {
    _prevScrollPosition = window.pageYOffset

	_body = document.body
    _nav = document.getElementById("nav")
    _navTop = document.getElementById("nav-top")
    _navBottom = document.querySelector("#nav-bottom nav")
    _navBottomLogo = document.getElementById("nav-bottom-logo")
    _navBottomMenu = document.getElementById("nav-bottom-menu")

    constructor () {
        super()
        this._navDisplay ()
        this._navTopDisplay ()
        this._navBottomDisplay ()
    }
}