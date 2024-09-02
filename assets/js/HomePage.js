class HeroSection {
    handlerClickVolumeButton () {
        this._sectionHero.addEventListener ("click", e => {
            const theNode = e.target
            const thePlay = theNode.closest("#hero-play-btn")
            const theMute = theNode.closest("#hero-mute-btn")

            if (thePlay) {
                console.log(thePlay)
            }
            
            if (theMute) {
                const icon = theMute.querySelector("i")
                if (icon && icon.className.includes("mute")) {
                    icon.className = icon.className.replace("mute", "up")
                }  else {
                    icon.className = icon.className.replace("up", "mute")
                }             
            }
        })
    }
    handlerEndVideo () {
        this._horoVideo.addEventListener("ended", e => {
            this._horoVideo.classList.toggle("none")
            this._horoImage.classList.toggle("none")
        })
    }
}

export default class HomePage extends HeroSection {
    _sectionHero = document.getElementById("hero-section")
    _horoVideo = document.getElementById("hero-video")
    _horoImage = document.getElementById("hero-image")

    constructor () {
        super ()
        this.handlerClickVolumeButton()
        this.handlerEndVideo ()
    }
}