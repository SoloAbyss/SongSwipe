let iteration = 0;

gsap.set('.cards li', {
	yPercent: 0,
	opacity: 0,
	scale: 0,
	xPercent: 0
});

const spacing = 0.1,
	snapTime = gsap.utils.snap(spacing),
	cards = gsap.utils.toArray('.cards li'),
	animateFunc = element => {
		const tl = gsap.timeline();
		tl.fromTo(element, {
				scale: 1,
				opacity: 1
			}, {
				scale: 1,
				opacity: 1,
				zIndex: 1,
				duration: 0.5,
				yoyo: true,
				repeat: 1,
				ease: "power1.in",
				immediateRender: false
			})
			.fromTo(element, {
				yPercent: 750 * 2
			}, {
				yPercent: -750 * 2,
				duration: 1,
				ease: "none",
				immediateRender: false
			}, 0);
		return tl;
	},
	seamlessLoop = buildSeamlessLoop(cards, spacing, animateFunc),
	playhead = {
		offset: 0
	}, 
	wrapTime = gsap.utils.wrap(0, seamlessLoop.duration()), 
	scrub = gsap.to(playhead, { 
		offset: 0,
		onUpdate() {
			seamlessLoop.time(wrapTime(playhead.offset));
		},
		duration: 0.5,
		ease: "power3",
		paused: true
	}),
	trigger = ScrollTrigger.create({
		start: 0,
		onUpdate(self) {
			let scroll = self.scroll();
			if (scroll > self.end - 1) {
				wrap(1, 1);
			} else if (scroll < 1 && self.direction < 0) {
				wrap(-1, self.end - 1);
			} else {
				scrub.vars.offset = (iteration + self.progress) * seamlessLoop.duration();
				scrub.invalidate().restart();
			}
		},
		end: "+=3000",
		pin: ".gallery"
	}),
	
	progressToScroll = progress => gsap.utils.clamp(1, trigger.end - 1, gsap.utils.wrap(0, 1, progress) * trigger.end),
	wrap = (iterationDelta, scrollTo) => {
		iteration += iterationDelta;
		trigger.scroll(scrollTo);
		trigger.update(); 
	};

function scrollToOffset(offset) {
	let snappedTime = snapTime(offset),
		progress = (snappedTime - seamlessLoop.duration() * iteration) / seamlessLoop.duration(),
		scroll = progressToScroll(progress);
	if (progress >= 1 || progress < 0) {
		return wrap(Math.floor(progress), scroll);
	}
	trigger.scroll(scroll);
}

document.querySelector(".next").addEventListener("click", () => scrollToOffset(scrub.vars.offset + spacing));
document.querySelector(".prev").addEventListener("click", () => scrollToOffset(scrub.vars.offset - spacing));


function buildSeamlessLoop(items, spacing, animateFunc) {
	let rawSequence = gsap.timeline({
			paused: true
		}),
		seamlessLoop = gsap.timeline({
			paused: true,
			repeat: -1,
			onRepeat() {
				this._time === this._dur && (this._tTime += this._dur - 0.01);
			},
			onReverseComplete() {
				this.totalTime(this.rawTime() + this.duration() * 100);
			}
		}),
		cycleDuration = spacing * items.length,
		dur;
items.concat(items).concat(items).forEach((item, i) => {
		let anim = animateFunc(items[i % items.length]);
		rawSequence.add(anim, i * spacing);
		dur || (dur = anim.duration());
	});


	seamlessLoop.fromTo(rawSequence, {
		time: cycleDuration + dur / 2
	}, {
		time: "+=" + cycleDuration,
		duration: cycleDuration,
		ease: "none"
	});
	return seamlessLoop;
}

let slider = document.querySelector('.slider');
let innerSlider = document.querySelector('.slider-inner');

let pressed = false;
let startx;
let x;

slider.addEventListener('mousedown', (e)=>{
    pressed = true;
    startx = e.offsetX - innerSlider.offsetLeft;
    slider.style.cursor = 'grabbing'
});

slider.addEventListener('mouseenter', ()=>{
    slider.style.cursor = 'grab'
});

slider.addEventListener('mouseup', ()=>{
    slider.style.cursor = 'grab'
});

window.addEventListener('mouseup', ()=>{
    pressed = false;
});

slider.addEventListener('mousemove', (e)=>{
    if(!pressed) return;
    e.preventDefault();

    x = e.offsetX

    innerSlider.style.left = `${x - startx}px`;

    checkboundary()
});

function checkboundary(){
    let outer = slider.getBoundingClientRect();
    let inner = innerSlider.getBoundingClientRect();

    if(parseInt(innerSlider.style.left) > 0){
        innerSlider.style.left = '0px';
    }else if(inner.right < outer.right){
        innerSlider.style.left = `-${inner.width - outer.width}px`
    } 
}

checkboundary()