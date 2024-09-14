class SliderUtilities {
    _getChildIndex(element) {
        if (!element || !element.parentNode) {
            console.error("Geçersiz element veya elementin parent'ı yok.");
            return -1;
        }

        const parent = element.parentNode;
        const children = Array.from(parent.children); // Parent'ın çocuklarını bir diziye çevir
        
        return children.indexOf(element); // Elementin index'ini bul ve döndür
    }
}
class SliderHandler {
    _goSlider () {
        this.currentData = this._slides
        const go = this._itemWidth * -this._index
        this._slides.style.transform = `translateX(calc(${go}px - ${this._index * this.gap}rem))`
    }
    _nextSlide () {
        if (this._index === this._maxLength) return

        this._index++
    }
    _prevSlide () {
        if (this._index < 1) return

        this._index--
    }
    handlerClickControl () {
        this._control.addEventListener("click", e => {
            const right = e.target.closest(".js-slider-control-right")
            const left = e.target.closest(".js-slider-control-left")
            
            if (right) {
                this._prevSlide()
            }
            
            if (left) {
                this._nextSlide()
            }

            this._goSlider ()
        })
    }
    _handlerResize () {
        window.addEventListener('resize', e => {
            this._index = 0
            this._goSlider ()
            this._updateControls ()
        })
    }
}
class Slider extends SliderHandler {
    _index = 0
    _html = document.documentElement
    _body = document.body

    constructor (slider) {
        super ()

        this.slider = slider

        this._updateControls ()
        this.handlerClickControl ()
        this._handlerResize ()
    }

    set slider (parent) {
        this._slider = parent
        this._slides = parent.querySelector (".js-slider-slides")
        this._control = parent.querySelector (".js-slider-control")
    }
    set currentData (slides) {
        this._itemWidth = slides.firstElementChild.clientWidth
        this._itemsCount = slides.childElementCount
        this._visibleItems = Math.floor(slides.clientWidth / this._itemWidth)
        this._maxLength = slides.childElementCount - this._visibleItems

        this._isShowControl = this._itemsCount > this._visibleItems
        console.log(this._itemsCount, this._visibleItems)
    }
    get gap () {
        const gap = parseFloat (window.getComputedStyle(this._slides).getPropertyValue("gap"), 10)
        const rootFontSize = parseFloat (window.getComputedStyle(this._html).fontSize, 10)
        return gap / rootFontSize
    }
    _updateControls () {
        if (!this._isShowControl)
            this._control.classList.add("js-slider-control-prevent")
        else
            this._control.classList.remove("js-slider-control-prevent")
    }
}
const sliders = document.querySelectorAll (".js-slider")
sliders.forEach (el => new Slider (el))