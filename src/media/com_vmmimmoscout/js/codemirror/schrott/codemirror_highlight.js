import {EditorState, StateEffect, StateField} from "../../../vendor/codemirror/js/codemirror-state";
import { Decoration } from "../../../vendor/codemirror/js/codemirror-view";
import { EditorView } from "../../../vendor/codemirror/js/codemirror-view";
import { optionsToExtensions } from "../../../plg_editors_codemirror/js/codemirror";
// Definieren Sie den StateEffect zum Hinzufügen von Zeilenhervorhebungen
const addLineHighlight = StateEffect.define();

// Definieren Sie das StateField, um die Zeilenhervorhebungen zu verwalten
const lineHighlightField = StateField.define({
    create() {
        return Decoration.none;
    },
    update(decorations, { effects }) {
        effects.forEach(effect => {
            if (effect.is(addLineHighlight)) {
                const { from, to } = effect.value;
                const lineDecoration = Decoration.line({ attributes: { class: 'marked-line' } });
                decorations = decorations.update({ add: [lineDecoration.range(from, to)] });
            }
        });
        return decorations;
    },
    provide: f => EditorView.decorations.from(f),
});

// Funktion zum Hervorheben von Zeilen in einem bestehenden Editor
export function highlightLines(editorView, lines) {
    const effects = [];

    for (const lineNo of lines) {
        const line = editorView.state.doc.line(lineNo);
        // Erstellen Sie eine Zeilendekoration, die nur den Anfang der Zeile angibt
        const lineDecoration = Decoration.line({ class: 'marked-line' });
        effects.push(addLineHighlight.of(lineDecoration.range(line.from)));
    }
    editorView.dispatch({ effects: effects });
}



export async function initializeCustomCodeMirror(textareaId, options) {
    const textarea = document.getElementById(textareaId);
    if (!textarea) return null;

    const extensions = [
        lineHighlightField,
    ];

    console.log('[initializeCustomCodeMirror] Extensions to apply:', extensions);
    console.log('Textarea: ', textarea);
    console.log('TextareaValue: ', textarea.value);

    const editorView = new EditorView({
        state: EditorState.create({
            doc: textarea.value,
            extensions: extensions
        }),
        parent: textarea.parentNode
    });

    console.log('[initializeCustomCodeMirror] EditorView created successfully.');

    textarea.style.display = 'none';
    console.log('[initializeCustomCodeMirror] Original textarea is now hidden.');
    return editorView;
}
