
export class V2 {
    get x(): number {
        return this._x;
    };
    get y(): number {
        return this._y;
    };

    constructor(
        private _x: number,
        private _y: number,
    ) { }

    static xy = (xy: number) => new V2(xy, xy);
    static empty = () => new V2(0, 0);

    div = (v2: V2) => new V2(this._x / v2.x, this._y / v2.y);
    dot = (v2: V2) => new V2(this._x * v2.x, this._y * v2.y);
    add = (v2: V2) => new V2(this._x + v2.x, this._y + v2.y);
    sub = (v2: V2) => new V2(this._x - v2.x, this._y - v2.y);
    max = (v2: V2) => new V2(Math.max(this._x, v2.x), Math.max(this._y, v2.y));
    min = (v2: V2) => new V2(Math.min(this._x, v2.x), Math.min(this._y, v2.y));
    hyp = () => Math.sqrt(Math.pow(this._x, 2) + Math.pow(this._y, 2));
    rot = (rad: number, phi: number) => new V2(
        this._x + Math.cos(phi) * rad,
        this._y + Math.sin(phi) * rad,
    );
    len = (len = 1) => {
        const hyp = this.hyp();
        return new V2(
            (this._x / hyp) * len,
            (this._y / hyp) * len,
        );
    }
}
