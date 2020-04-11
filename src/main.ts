import "./style.scss";
import { Store, State } from "./store";
import { V2 } from './v2';

export default () => {
  window.onload = ready;
};

function ready() {
  handleScroll();
  document.addEventListener('scroll', handleScroll);
  setTimeout(() => document.body.classList.toggle('transitions', true), 0);
  bg();
}  

function handleScroll() {
  const { scrollTop, scrollHeight, clientHeight } = document.scrollingElement;
  const bias = 4;
  const isReading = (scrollTop > bias) && (scrollHeight - scrollTop - clientHeight > bias);
  document.body.classList.toggle('reading', isReading);
}

function bg() {
  const canvas = document.querySelector('.bg') as HTMLCanvasElement;
  const ctx = canvas.getContext('2d');

  let mPos: V2;
  document.body.addEventListener('mousemove', evt => mPos = new V2(evt.pageX, evt.pageY));

  setInterval(update, 40);
  let time = 0;
  let points: Point[][];
  let cPos: V2;
  let target: V2;

  function update() {
    ++time;
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;
    const dim = new V2(canvas.width, canvas.height);
    const center = dim.div(V2.xy(2));
    // mPos = mPos ?? center;
    cPos = cPos ?? center;
    points = points ?? getPointGrid(20, dim);
    ctx.clearRect(0, 0, dim.x, dim.y);

    points.forEach(a => a.forEach(p => p.update(cPos)));


    if (!target || target.sub(cPos).hyp() < 4) {
      target = dim.dot(new V2(Math.random(), Math.random()));
    }
    cPos = target.sub(cPos).len(4).add(cPos);

    // const mMoving = center
    //   .add(mPos.sub(center).len(80));

    // drawPoint(mPos);
    // drawPoint(center);
    // drawPoint(moving);
    // drawPoint(mMoving);

    points.forEach(col => {
      // ctx.beginPath();
      col.forEach((point, i) => {
        if (point.color === 'transparent') return;
        // ctx[i === 0 ? 'moveTo' : 'lineTo'](point.pos.x, point.pos.y);
        point.draw(ctx);
      });
      // ctx.strokeStyle = '#333';
      // ctx.lineWidth = 2;
      // ctx.stroke();
      // ctx.closePath();
      // drawPoint(p.pos)
    });
  }

  function drawPoint(v2: V2) {
    ctx.beginPath();
    ctx.arc(v2.x, v2.y, 1, 0, Math.PI * 2);
    ctx.fillStyle = '#aaa';
    ctx.fill();
    ctx.closePath();
  }

  function getPointGrid(s: number, dim: V2) {
    const rows = Array.from(Array(~~(dim.y / s) + 1)).map((_, i) => i);
    const cols = Array.from(Array(~~(dim.x / s) + 1)).map((_, i) => i);
    return rows
      .map(r => cols
        .filter(() => Math.random() > .8)
        .map(c => new Point(new V2(c * s, r * s))));
  }
}

class Point {
  private vel = V2.xy(0);
  private initialPos: V2;
  color: string;

  constructor(
    public pos: V2,
  ) {
    this.initialPos = pos;
  }

  draw(ctx: CanvasRenderingContext2D) {
    ctx.beginPath();
    ctx.save();
    ctx.translate(this.pos.x, this.pos.y);

    ctx.moveTo(-4, -4);
    ctx.lineTo(4, 4);
    ctx.moveTo(4, -4);
    ctx.lineTo(-4, 4);

    ctx.strokeStyle = '#0029f2';
    ctx.stroke();
    // ctx.fillRect(0,0,4,4);
    ctx.restore();
    ctx.closePath();
  }

  update(mPos: V2) {
    // const deltaMPos = mPos.sub(this.pos);
    // const mForce = deltaMPos.div(
    //   V2.xy(Math.pow(deltaMPos.hyp(), 3) * -.1),
    // );
    const len = 140;
    const deltaPos = this.initialPos
      .sub(mPos);

    if (deltaPos.hyp() > len + 120) {
      this.color = 'transparent';
    } else {
      this.color = 'white';
    }


    if (deltaPos.hyp() > len) {
      this.pos = this.initialPos;
      return;
    }


    const height = 40;

    this.pos = this.initialPos
      .add(new V2(0, -((1 - deltaPos.hyp() / len)) * height));
    // deltaPos
    //   .len(deltaPos.hyp() / 2)
    //   .add(mPos);

    // this.vel = this.vel.add(force);
    // this.pos = this.pos.add(this.vel);
  }
}
