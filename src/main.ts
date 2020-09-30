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
  const sticks = Sticks(canvas, ctx);

  canvas.width = canvas.clientWidth;
  canvas.height = canvas.clientHeight;

  setInterval(() => sticks.update(), 80);
  paint();
  function paint() {
    sticks.paint();
    requestAnimationFrame(() => paint());
  }
}

function Sticks(canvas: HTMLCanvasElement, ctx: CanvasRenderingContext2D) {
  let time = 0;

  return {
    update,
    paint,
  };

  function update() {
    time++;
  }

  function paint() {
    const dim = new V2(canvas.width, canvas.height);
    ctx.clearRect(0, 0, dim.x, dim.y);
    const s = 8;
    const p = 2;
    ctx.fillStyle = 'white';
    for (let y = 0; y < dim.y; y += s + p) {
      ctx.fillStyle = `rgba(255,255,255,${(y % 100) / 280})`;
      ctx.fillRect(80, y, 180 * Math.sin((time + y) * .01) + 20, s);
    }
  }
}

function Net(canvas: HTMLCanvasElement, ctx: CanvasRenderingContext2D) {
  canvas.width = canvas.clientWidth;
  canvas.height = canvas.clientHeight;
  const dim = new V2(canvas.width, canvas.height);

  let lines: V2[][] = [
    getLine(dim),
    getLine(dim),
    getLine(dim),
    getLine(dim),
    getLine(dim),
    getLine(dim),
    getLine(dim),
    getLine(dim),
  ];

  return {
    update,
    paint,
  };

  function update() {
    const speed = .01;
    lines.forEach((line, i) => {
      const otherLine = lines[lines.length - 1 - i];
      line.find((pos, h) => {
        const target = otherLine[h];
        const dir = target.sub(pos);

        if (dir.hyp() <= speed) {
          // lines[i] = getLine(dim);
          return true;
        }

        const newPos = pos.add(dir.len(speed));
        line[h] = newPos;
      });
    });
  }

  function paint() {
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;
    const dim = new V2(canvas.width, canvas.height);
    ctx.clearRect(0, 0, dim.x, dim.y);

    lines.forEach((line, i) => {
      ctx.beginPath();
      line.forEach((pos, h) => ctx[h === 0 ? 'moveTo' : 'lineTo'](pos.x, pos.y));

      ctx.strokeStyle = '#aaa';
      ctx.lineWidth = 2;
      ctx.stroke();
      ctx.closePath();

      ctx.beginPath();

      line.forEach(pos => {
        lines.slice(i + 1, lines.length).flat()
          .filter(lineTo => lineTo.sub(pos).hyp() < 40)
          .forEach(lineTo => {
            ctx.moveTo(pos.x, pos.y);
            ctx.lineTo(lineTo.x, lineTo.y);
          });
      });
      ctx.closePath();

      ctx.strokeStyle = '#eee';
      ctx.lineWidth = 1;
      ctx.stroke();
    });
  }
}

function getLine(dim: V2) {
  const len = 102;
  const d = 120;
  const line = [dim.dot(new V2(
    .5,
    .5,
  ))];
  let last: V2;
  for (let i=0; i<len; i++) {
    last = line[line.length - 1];
    line.push(new V2(
      ~~(Math.random() * d) - d / 2,
      ~~(Math.random() * d) - d / 2,
    ).add(last));
  }
  return line;
}
