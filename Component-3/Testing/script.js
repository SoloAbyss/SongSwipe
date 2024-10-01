let slider = document.querySelector('.filter-container');
let innerSlider = document.querySelector('.filter-inner');

let pressed = false;
let startx;
let x;
let velocity = 0;
let animationFrameId;

let lastMousePosition;
let lastTimestamp;

slider.addEventListener('mousedown', (e) => {
    pressed = true;
    startx = e.offsetX - innerSlider.offsetLeft;
    slider.style.cursor = 'grabbing';
    
    cancelAnimationFrame(animationFrameId);  // Stop any ongoing inertia
    lastMousePosition = e.offsetX;  // Store the initial mouse position
    lastTimestamp = Date.now();     // Store the timestamp for velocity calculation
});

slider.addEventListener('mouseenter', () => {
    slider.style.cursor = 'grab';
});

slider.addEventListener('mouseup', () => {
    slider.style.cursor = 'grab';
});

window.addEventListener('mouseup', () => {
    if (pressed) {
        pressed = false;
        // Start the inertia when the mouse is released
        requestInertia();
    }
});

slider.addEventListener('mousemove', (e) => {
    if (!pressed) return;
    e.preventDefault();

    x = e.offsetX;
    let newLeft = x - startx;

    innerSlider.style.left = `${newLeft}px`;

    // Calculate velocity
    let currentTimestamp = Date.now();
    let timeDiff = currentTimestamp - lastTimestamp;
    let mouseMovement = e.offsetX - lastMousePosition;
    velocity = mouseMovement / timeDiff;  // Velocity = distance / time

    // Store current position and timestamp for the next calculation
    lastMousePosition = e.offsetX;
    lastTimestamp = currentTimestamp;

    checkboundary();
});

function checkboundary() {
    let outer = slider.getBoundingClientRect();
    let inner = innerSlider.getBoundingClientRect();

    if (parseInt(innerSlider.style.left) > 0) {
        innerSlider.style.left = '0px';
    } else if (inner.right < outer.right) {
        innerSlider.style.left = `-${inner.width - outer.width}px`;
    }
}

// Function to animate the inertia after mouse release
function requestInertia() {
    const friction = 0.9;  // A friction value less than 1 to slow down the slider over time

    function inertia() {
        if (Math.abs(velocity) > 0.01) {  // Minimum threshold to stop animation
            // Move the slider by the current velocity
            innerSlider.style.left = `${parseInt(innerSlider.style.left) + velocity * 10}px`;

            // Apply friction to reduce velocity
            velocity *= friction;

            checkboundary();  // Ensure boundaries are respected

            // Continue the animation
            animationFrameId = requestAnimationFrame(inertia);
        } else {
            cancelAnimationFrame(animationFrameId);
        }
    }

    // Start the inertia animation
    inertia();
}

checkboundary();


let iteration = 0;

gsap.set('.songs li', {
	yPercent: 0,
	opacity: 0,
	scale: 0,
});

const spacing = 0.1,
	snapTime = gsap.utils.snap(spacing),
	songs = gsap.utils.toArray('.songs li'),
	animateFunc = element => {
		const tl = gsap.timeline();
		tl.fromTo(element, {
				scale: 1,
				opacity: 1
			}, {
				scale: 1,
				opacity: 1,
				zIndex: 100,
				duration: 0.5,
				yoyo: true,
				repeat: 1,
				ease: "power1.in",
				immediateRender: false
			})
			.fromTo(element, {
				yPercent: 400 * 2
			}, {
				yPercent: -400 * 2,
				duration: 1,
				ease: "none",
				immediateRender: false
			}, 0);
		return tl;
	},
	seamlessLoop = buildSeamlessLoop(songs, spacing, animateFunc),
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
		pin: ".media-carousel"
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

