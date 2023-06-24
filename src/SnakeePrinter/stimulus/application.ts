import { Application, Controller } from '@hotwired/stimulus'
window.Stimulus = Application.start()

export class SnakeeController extends Controller {
    static values = {
        name: { type: String, default: 'Names!!!' },
    }
    static targets = ['name'];

    connect() {
        this.nameTarget.innerHTML = this.nameValue;
    }
}

Stimulus.register('snakee', SnakeeController);
