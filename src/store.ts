export interface State {
    page: number,
}

export class Store {
    private modifiers: (() => boolean)[] = [];
    private state: State;

    constructor() { }
    
    addModifier(scope: string, event: string, modifier: any) {
        this.modifiers.push(modifier);
    }

    addEvent(name: string, dispatcher: (dispatch: (evt: any) => void) => any) {
        dispatcher(ev => {
            console.log(name);
        });
    }
}
