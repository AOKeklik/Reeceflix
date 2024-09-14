class Utils {
    static fadeIn (el, duration=500) {
        $(el).fadeIn()
    }
    static fadeOut (el, duration = 500) {
        $(el).fadeOut()
    }
}

class Section {
    constructor (section) {
        this.el = section
    }
    getId (el) {
        return parseInt(el.dataset.id, 10)
    }
    on (cb, event, node = null) {
        const that = this

        if (event === "mousemove") this.el.addEventListener ("mousemove", e => {
            if (node) {
                this.theNode = e.target.closest(node)
                if (!this.theNode) return
                cb({e, that})
            } else 
                cb({e, that})
        })

        if (event === "click") this.el.addEventListener ("click", e => {
            if (node) {
                this.theNode = e.target.closest(node)
                if (!this.theNode) return
                cb({e, that})
            } else 
                cb({e, that})
        })

        return this
    }
    goToPageById (id) {
        const newUrl = `${ROOT_DIR}watch/${id}`
        window.location.href = newUrl 
        return this
    }
    setProperty (name, selec) {
        this[name] = selec
    }
    getData (dataAttribute, element = this.el) {
        if (element.dataset && element.dataset[dataAttribute]) {
            return element.dataset[dataAttribute];
        }
        for (let child of element.children) {
            let result = this.getData(dataAttribute, child);
            if (result) {
                return result;
            }
        }
        return null;
    }
}

class Video {
    constructor (video) {
        this.el = video
    }
    on (cb, event, node = null) {

        if (event === "playing") this.el.addEventListener ("playing", e => {
            if (node) {
                this.theNode = e.target.closest(node)
                cb(e, this.theNode)
            } else 
                cb(e)
        })

        if (event === "pause") this.el.addEventListener ("pause", e => {
            if (node) {
                this.theNode = e.target.closest(node)
                if (!this.theNode) return
                cb(e, this.theNode)
            } else 
                cb(e)
        })

        if (event === "ended") this.el.addEventListener ("ended", e => {
            if (node) {
                this.theNode = e.target.closest(node)
                if (!this.theNode) return
                cb(e, this.theNode)
            } else 
                cb(e)
        })

        return this
    }
    play (ms = 0) {
        this.el.currentTime = ms
        this.el.play()

        return this
    }
}

class WatchSection {
    _ajaxGetProgress = ROOT_DIR + "core/ajax/watch-getDuration.php"
    _ajaxAddDuration = ROOT_DIR + "core/ajax/watch-addDuration.php"
    _ajaxUpdateDuration = ROOT_DIR + "core/ajax/watch-updateDuration.php"
    _ajaxUpdateFinished = ROOT_DIR + "core/ajax/watch-updateFinished.php"

    _watch = document.getElementById("watch-section")
    _watchGoback = document.getElementById("watch-goback")
    _watchVideo = document.getElementById("watch-video")
    _watchUpNext = document.getElementById("watch-upnext")
    _watchPlayButton = document.getElementById("watch-play-btn")

    constructor () {
        this.section = new Section (this._watch)
        this.video = new Video (this._watchVideo)

        if (!this.section.el) return
        if (!this.video.el) return

        this._handlerHoverWatchSection ()
        this._handlerClickReplay ()
        this._handlerClickPlay ()
        this._handlerEndedVido ()
        this._setProgress ()
        this._updateProgressTimer ()
    }
    
    _handlerHoverWatchSection () {
        let timeout = null
        
        this.section.on (e => {
            clearTimeout (timeout)
            Utils.fadeIn(this._watchGoback)

            timeout = setTimeout (() => {
                Utils.fadeOut(this._watchGoback)
            }, 2000)
        }, "mousemove")
    }
    _handlerClickReplay () {
        this.section.on (() => {

            this.video.play(0)
            Utils.fadeOut(this._watchUpNext)

        }, "click", "#watch-replay-btn")
    }
    _handlerClickPlay () {        
        this.section.on (({that}) => {
            
            const id = that.getId (this._watchPlayButton)
            that.goToPageById (id)

        }, "click", "#watch-play-btn")
    }
    _handlerEndedVido () {
        this.video.on (() => {
            Utils.fadeIn(this._watchUpNext)
        }, "ended")
    }
    _updateProgressTimer () {
        this._addDuration () 

        let timer

        this.video.on (e => {
            window.clearInterval (timer)
            
            timer = window.setInterval (() => {
                let currentTime = e.target.currentTime
                this._updateProgress (currentTime)
            }, 3000)

        }, "playing")
        
        this.video.on (e => {
            window.clearInterval (timer)         
        }, "pause")

        this.video.on (e => {
            window.clearInterval (timer)  
            this._updateFinished ()         
        }, "ended")

    }

    _setProgress () {
        const mnn = function (e) {
            $.post(ROOT_DIR + "core/ajax/watch-getDuration.php", {
                videoId: VIDEO_ID,
                userMail: USER_MAIL,
            }, data => {
                if (isNaN(data)) {
                    console.log(data)
                    return
                }
                this.currentTime = data;
            })

            this.removeEventListener ("canplay", mnn)
        }
        this.video.el.addEventListener("canplay", mnn)

        
    }
    _addDuration () {
        $.post(this._ajaxAddDuration, {
            videoId: VIDEO_ID,
            userMail: USER_MAIL
        }, data => {
            if (data !== null || data !== "")
                console.log(data)
            else 
                console.log("err")
        })
    }
    _updateProgress (currentTime) {
        $.post(this._ajaxUpdateDuration, {
            videoId: VIDEO_ID,
            userMail: USER_MAIL,
            duration: currentTime,
        }, data => {
            if (data !== null || data !== "")
                console.log(data)
            else 
                console.log("err")
        })
    }
    _updateFinished () {
        $.post(this._ajaxUpdateFinished, {
            videoId: VIDEO_ID,
            userMail: USER_MAIL,
        }, data => {
            if (data !== null || data !== "")
                console.log(data)
            else 
                console.log("err")
        })
    }
}

class HeroSection {
    _sectionHero = document.getElementById("hero-section")
    _horoVideo = document.getElementById("hero-video")
    _horoImage = document.getElementById("hero-image")

    constructor () {
        this.section = new Section(this._sectionHero)

        if (!this.section.el) return 

        this._handlerClickVolumeButtonHeroSection()
        this._handlerClick () 
        this._handlerEndVideoHeroSection ()
    }

    _handlerClickVolumeButtonHeroSection () {
        if (!this._sectionHero) return

        this._sectionHero.addEventListener ("click", e => {
            const theNode = e.target
            const thePlay = theNode.closest("#hero-play-btn")
            const theMute = theNode.closest("#hero-mute-btn")

            if (thePlay) {
                // console.log(thePlay)
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
    _handlerClick () {
        this.section.on (({that}) => {
            that.setProperty ("theVideoId", this.section.getData("videoid")) 
            that.goToPageById (that.theVideoId)
        }, "click", "#hero-play-btn")
    }
}





new HeroSection ()
new WatchSection ()