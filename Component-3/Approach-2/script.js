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
    const friction = 0.92;  // A friction value less than 1 to slow down the slider over time

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




gsap.registerPlugin(ScrollTrigger);

let iteration = 0; // gets iterated when we scroll all the way to the end or start and wraps around - allows us to smoothly continue the playhead scrubbing in the correct direction.

// set initial state of items
gsap.set('.songs li', {xPercent: 400, opacity: 0, scale: 0});

const spacing = 0.1, // spacing of the cards (stagger)
	snapTime = gsap.utils.snap(spacing), // we'll use this to snapTime the playhead on the seamlessLoop
	cards = gsap.utils.toArray('.songs li'),
	// this function will get called for each element in the buildSeamlessLoop() function, and we just need to return an animation that'll get inserted into a master timeline, spaced
	animateFunc = element => {
		const tl = gsap.timeline();
		tl.fromTo(element, {scale: 0, opacity: 0}, {scale: 1, opacity: 1, zIndex: 100, duration: 0.5, yoyo: true, repeat: 1, ease: "power1.in", immediateRender: false})
		  .fromTo(element, {xPercent: 400}, {xPercent: -400, duration: 1, ease: "none", immediateRender: false}, 0);
		return tl;
	},
	seamlessLoop = buildSeamlessLoop(cards, spacing, animateFunc),
	playhead = {offset: 0}, // a proxy object we use to simulate the playhead position, but it can go infinitely in either direction and we'll just use an onUpdate to convert it to the corresponding time on the seamlessLoop timeline.
	wrapTime = gsap.utils.wrap(0, seamlessLoop.duration()), // feed in any offset (time) and it'll return the corresponding wrapped time (a safe value between 0 and the seamlessLoop's duration)
	scrub = gsap.to(playhead, { // we reuse this tween to smoothly scrub the playhead on the seamlessLoop
		offset: 0,
		onUpdate() {
			seamlessLoop.time(wrapTime(playhead.offset)); // convert the offset to a "safe" corresponding time on the seamlessLoop timeline
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
				wrap(1, 2);
			} else if (scroll < 1 && self.direction < 0) {
				wrap(-1, self.end - 2);
			} else {
				scrub.vars.offset = (iteration + self.progress) * seamlessLoop.duration();
				scrub.invalidate().restart(); // to improve performance, we just invalidate and restart the same tween. No need for overwrites or creating a new tween on each update.
			}
		},
		end: "+=3000",
		pin: ".media-carousel"
	}),
	// converts a progress value (0-1, but could go outside those bounds when wrapping) into a "safe" scroll value that's at least 1 away from the start or end because we reserve those for sensing when the user scrolls ALL the way up or down, to wrap.
	progressToScroll = progress => gsap.utils.clamp(1, trigger.end - 1, gsap.utils.wrap(0, 1, progress) * trigger.end),
	wrap = (iterationDelta, scrollTo) => {
		iteration += iterationDelta;
		trigger.scroll(scrollTo);
		trigger.update(); // by default, when we trigger.scroll(), it waits 1 tick to update().
	};

// when the user stops scrolling, snap to the closest item.
ScrollTrigger.addEventListener("scrollEnd", () => scrollToOffset(scrub.vars.offset));

// feed in an offset (like a time on the seamlessLoop timeline, but it can exceed 0 and duration() in either direction; it'll wrap) and it'll set the scroll position accordingly. That'll call the onUpdate() on the trigger if there's a change.
function scrollToOffset(offset) { // moves the scroll playhead to the place that corresponds to the totalTime value of the seamlessLoop, and wraps if necessary.
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
	let rawSequence = gsap.timeline({paused: true}), // this is where all the "real" animations live
		seamlessLoop = gsap.timeline({ // this merely scrubs the playhead of the rawSequence so that it appears to seamlessly loop
			paused: true,
			repeat: -1, // to accommodate infinite scrolling/looping
			onRepeat() { // works around a super rare edge case bug that's fixed GSAP 3.6.1
				this._time === this._dur && (this._tTime += this._dur - 0.01);
			},
      onReverseComplete() {
        this.totalTime(this.rawTime() + this.duration() * 100); // seamless looping backwards
      }
		}),
		cycleDuration = spacing * items.length,
		dur; // the duration of just one animateFunc() (we'll populate it in the .forEach() below...

	// loop through 3 times so we can have an extra cycle at the start and end - we'll scrub the playhead only on the 2nd cycle
	items.concat(items).concat(items).forEach((item, i) => {
		let anim = animateFunc(items[i % items.length]);
		rawSequence.add(anim, i * spacing);
		dur || (dur = anim.duration());
	});

	// animate the playhead linearly from the start of the 2nd cycle to its end (so we'll have one "extra" cycle at the beginning and end)
	seamlessLoop.fromTo(rawSequence, {
		time: cycleDuration + dur / 2
	}, {
		time: "+=" + cycleDuration,
		duration: cycleDuration,
		ease: "none"
	});
	return seamlessLoop;
}


// below is the dragging functionality (mobile-friendly too)...
Draggable.create(".drag-proxy", {
  type: "x",
  trigger: ".songs",
  onPress() {
    this.startOffset = scrub.vars.offset;
  },
  onDrag() {
    scrub.vars.offset = this.startOffset + (this.startX - this.x) * 0.001;
    scrub.invalidate().restart(); // same thing as we do in the ScrollTrigger's onUpdate
  },
  onDragEnd() {
    scrollToOffset(scrub.vars.offset);
  }
});