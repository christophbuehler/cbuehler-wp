import "./style.scss";
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
  const { scrollTop } = document.scrollingElement;
  const bias = 4;
  const isReading = (scrollTop > bias);
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
  const s = 20;

  function update() {
    ++time;
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;
    const dim = new V2(canvas.width, canvas.height);
    const center = dim.div(V2.xy(2));
    cPos = cPos ?? center;
    points = points ?? getPointGrid(s, dim);
    ctx.clearRect(0, 0, dim.x, dim.y);

    points.forEach(a => a.forEach(p => p.update(cPos)));

    if (!target || target.sub(cPos).hyp() < 4) {
      target = dim.dot(new V2(Math.random(), Math.random()));
    }
    cPos = target.sub(cPos).len(4).add(cPos);
    points.forEach(col => {
      col.forEach((point, i) => {
        if (point.color === 'transparent') return;
        point.draw(ctx, s);
      });
    });
  }

  function getPointGrid(s: number, dim: V2) {
    const rows = Array.from(Array(~~(dim.y / s) + 1)).map((_, i) => i);
    const cols = Array.from(Array(~~(dim.x / s) + 1)).map((_, i) => i);
    return rows
      .map((r, i) => cols
        .filter(() => Math.random() > 0)
        .map(c => new Point(new V2((c  + (i % 2) * .5) * s, (r) * s))));
  }
}

class Point {
  private initialPos: V2;

  color: string;

  constructor(
    public pos: V2,
  ) {
    this.initialPos = pos;
  }

  draw(ctx: CanvasRenderingContext2D, s: number) {
    ctx.beginPath();
    ctx.save();
    ctx.translate(this.pos.x, this.pos.y);

    s = s - 4;

    const hs = s;

    ctx.moveTo(-s * .5, hs * .5);
    ctx.lineTo(-s * .5, -hs * .5);

    ctx.lineTo(0, -hs * .5);

    ctx.lineTo(s * .5, -hs * .5);
    ctx.lineTo(s * .5, hs * .5);

    ctx.closePath();
    ctx.strokeStyle = this.color;
    ctx.stroke();
    ctx.restore();
  }

  update(mPos: V2) {
    const len = 140;
    const deltaPos = this.initialPos
      .sub(mPos);

    if (deltaPos.hyp() > len + 120) {
      this.color = 'transparent';
    } else {
      const alpha = ((len - deltaPos.hyp()) / len);
      this.color = `rgba(255,255,255,${Math.max(alpha, .2)})`;
    }

    if (deltaPos.hyp() > len) {
      this.pos = this.initialPos;
      return;
    }

    const height = 40;
    this.pos = this.initialPos
      .add(new V2(0, -((1 - deltaPos.hyp() / len)) * height));
  }
}
