const manaDisplay = document.getElementById("mana-total")
const manaCap = document.getElementById("manaCap")
const manaEff = document.getElementById("manaEff")
let manaTotal
let mEff
let mCap
let mUse
let mSUse
let mNext
document.getElementById("apply").addEventListener("click",apply);
document.getElementById("use").addEventListener("click", use);
document.getElementById("next").addEventListener("click", next);
function apply() {
    mEff = parseInt(document.getElementById("manaEff").value)
    mCap = parseInt(document.getElementById("manaCap").value)
    manaTotal = mEff * mCap
    manaDisplay.innerHTML = manaTotal
}
function use() {
    mUse = parseInt(document.getElementById("manaUse").value)
    manaTotal -= mUse
    manaDisplay.innerHTML = manaTotal
}
function next() {
    mEff = parseInt(document.getElementById("manaEff").value)
    mCap = parseInt(document.getElementById("manaCap").value)
    if (manaDisplay.innerHTML < mEff * mCap) {
        mNext = (mEff * mCap) / 20
        manaTotal += mNext
        manaDisplay.innerHTML = manaTotal
    } else if (manaDisplay.innerHTML > mEff * mCap) {
        manaTotal = mEff * mCap
        manaDisplay.innerHTML = manaTotal
    }
    
    if (manaDisplay.innerHTML > mEff * mCap) {
        manaTotal = mEff * mCap
        manaDisplay.innerHTML = manaTotal
    }
}
 
function fitToScreen(widthHeightRatio, imageId){
    var fitTo = "width"
    var fullscreen = false

    var windowHeight = (window.outerHeight*0.8).toString()
    var windowWidth = (window.outerWidth*0.54).toString()

    var winHeight = windowHeight.split(".")
    var maxHeight = parseInt(winHeight[0])

    var winWidth = windowWidth.split(".")
    var maxWidth = parseInt(winWidth[0])

    var imgHeight = window.getComputedStyle(document.getElementById(imageId)).height
    var imgsHeight = imgHeight.split("px")
    var imageHeight = parseInt(imgsHeight[0])

    var imgWidth = window.getComputedStyle(document.getElementById(imageId)).width
    var imgsWidth = imgWidth.split("px")
    var imageWidth = parseInt(imgsWidth[0])

    if(imageHeight == maxHeight)  fullscreen = true
    if(imageWidth == maxWidth) fullscreen = true

    if(widthHeightRatio >= 1) fitTo = "width"
    if(widthHeightRatio < 1) fitTo = "height"
    if(fitTo == "width" && fullscreen == false){
        var endWidth = window.outerWidth*0.54
        document.getElementById(imageId).style.height = (endWidth/imageWidth)*imageHeight+"px"
        document.getElementById(imageId).style.width = endWidth+"px"

        document.getElementById("tools").style.overflow = "scroll"

        document.getElementById(imageId).style.left = "calc(50% - "+endWidth/2+"px)"
        document.getElementById(imageId).style.top = "calc(50% - "+((endWidth/imageWidth)*imageHeight)/2+"px)"
        
        document.getElementById(imageId).style.position = "absolute"

        return "good"
    }
    if(fitTo == "height" && fullscreen == false){
        var endHeight = window.outerHeight*0.8
        document.getElementById(imageId).style.height = endHeight+"px"
        document.getElementById(imageId).style.width = (endHeight/imageHeight)*imageWidth+"px"

        document.getElementById("tools").style.overflow = "scroll"

        document.getElementById(imageId).style.left = "calc(50% - "+((endHeight/imageHeight)*imageWidth)/2+"px)"
        document.getElementById(imageId).style.top = "calc(50% - "+endHeight/2+"px)"

        document.getElementById(imageId).style.position = "absolute"

        return "good"
    }
    if(fullscreen == true){
        return "revert"
    }
}

function image(id, initialWidth){

    var width = window.getComputedStyle(document.getElementById(id)).width;
    var newWidth = width.split("px")
    var intWidth = parseInt(newWidth[0])
    var height = window.getComputedStyle(document.getElementById(id)).height;
    var newHeight = height.split("px")
    var intHeight = parseInt(newHeight[0])
    if(fitToScreen(intWidth/intHeight, id) == "good") return
    if(fitToScreen(intWidth/intHeight, id) == 'revert'){
        document.getElementById("tools").style.overflow = "scroll"
        document.getElementById(id).style.width = initialWidth+"px"
        document.getElementById(id).style.height = "fit-content"
        document.getElementById(id).style.left = "inherit"
        document.getElementById(id).style.top = "inherit"
        document.getElementById(id).style.position = "inherit"
    }
}