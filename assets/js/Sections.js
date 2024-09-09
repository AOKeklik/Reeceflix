class Section {
    _section
    constructor (parentElement) {
        
    }
    set setSection (parentElement) {
        this._section = parentElement
    }
    _mousemove (cb) {
        return this._section.addEventListener ("mousemove", cb.bind(this))
    }
}

class WatchSection extends Section {
    _ajaxAddDuration = ROOT_DIR + "core/ajax/watch-addDuration.php"
    _watchGoback = document.getElementById("watch-goback")

    constructor () {
        super ()

        this.setSection = document.getElementById("watch-section")
        if (!this._section) return

        this._handlerHoverWatchSection ()
        this._updateProgressTimer ()
    }
    
    _handlerHoverWatchSection () {
        let timeout = null
        
        this._mousemove (e => {
            clearTimeout (timeout)
            Utils.fadeIn(this._watchGoback)

            timeout = setTimeout (() => {
                Utils.fadeOut(this._watchGoback)
            }, 2000)
        })
    }
    _updateProgressTimer () {
        this._addDuration () 

    }
    _addDuration () {
        $.post(this._ajaxAddDuration, {
            videoId: VIDEO_ID,
            userMail: USER_MAIL
        }, data => {
            console.log(data)
        })
    }
}

class HeroSection extends Section {
    _sectionHero = document.getElementById("hero-section")
    _horoVideo = document.getElementById("hero-video")
    _horoImage = document.getElementById("hero-image")

    constructor () {
        super ()

        this._handlerClickVolumeButtonHeroSection()
        this._handlerEndVideoHeroSection ()
    }

    _handlerClickVolumeButtonHeroSection () {
        if (!this._sectionHero) return

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
    _handlerEndVideoHeroSection () {  
        if (!this._horoVideo) return

        this._horoVideo.addEventListener("ended", e => {
            this._horoVideo.classList.toggle("none")
            this._horoImage.classList.toggle("none")
        })
    }
}


class Utils {
    static fadeIn (el, duration=500) {
        $(el).fadeIn()
    }
    static fadeOut (el, duration = 500) {
        $(el).fadeOut()
    }
    
}

new HeroSection ()
new WatchSection ()