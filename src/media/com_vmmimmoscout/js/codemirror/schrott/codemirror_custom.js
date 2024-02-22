// Importieren der notwendigen CodeMirror-Module
import { EditorState, StateField, StateEffect } from "../../../vendor/codemirror/js/codemirror-state";
import { EditorView, Decoration } from "../../vendor/codemirror/js/codemirror-view";
import { createFromTextarea, minimalSetup, optionsToExtensions } from "../../../plg_editors_codemirror/js/codemirror";
import {basicSetup} from "./codemirror_basicSetup";

const addDecorationsEffect = StateEffect.define();

// Erstellen Sie ein Zustandsfeld, das Ihre Dekorationen speichert
const decorationsField = StateField.define({
    create() {
        return Decoration.none;
    },
    update(decorations, transaction) {
        // Aktualisieren Sie die Dekorationen basierend auf den Transaktionseffekten
        for (const effect of transaction.effects) {
            if (effect.is(addDecorationsEffect)) {
                return effect.value;
            }
        }
        return decorations.map(transaction.changes);
    },
    provide: f => EditorView.decorations.from(f)
});

export function markTextByLines(editorView, fromLine, toLine) {
    console.log(`[markTextByLines] Starting to mark lines from ${fromLine} to ${toLine}`);

    const decorations = [];
    const myDecoration = Decoration.mark({ class: "marked-text" });
    console.log('[markTextByLines] Decoration to apply:', myDecoration);

    for (let i = parseInt(fromLine); i <= parseInt(toLine); i++) {
        const line = editorView.state.doc.line(i);
        if (line) {
            console.log(`[markTextByLines] Line ${i}: from ${line.from} to ${line.to}, text: "${line.text}"`);
            decorations.push(myDecoration.range(line.from, line.to));
        } else {
            console.log(`[markTextByLines] No line found for index ${i}`);
        }
    }

    if (decorations.length > 0) {
        console.log('[markTextByLines] Final decorations:', decorations);
        console.log('[markTextByLines] Elements to be marked with "marked-text":', decorations.map(d => `Line from ${d.from} to ${d.to}`).join(', '));
        const transaction = editorView.state.update({
            effects: addDecorationsEffect.of(Decoration.set(decorations))
        });
        editorView.dispatch(transaction);
        console.log('[markTextByLines] Transaction dispatched successfully.');
    } else {
        console.log('[markTextByLines] No decorations to apply.');
    }
}

export async function initializeCustomCodeMirror(textareaId, options) {
    console.log(`[initializeCustomCodeMirrorTest] Initializing custom CodeMirror for textarea with ID: ${textareaId}`);
    const textarea = document.getElementById(textareaId);
    if (!textarea) {
        console.log(`[initializeCustomCodeMirrorTest] No textarea found with ID: ${textareaId}`);
        return null;
    }

    const extensions = [minimalSetup, basicSetup, decorationsField, ...await optionsToExtensions(options)];
    console.log('[initializeCustomCodeMirrorTest] Extensions to apply:', extensions);

    const editorView = new EditorView({
        state: EditorState.create({
            doc: textarea.value,
            extensions: extensions
        }),
        parent: textarea.parentNode
    });
    console.log('[initializeCustomCodeMirrorTest] EditorView created successfully.');

    textarea.style.display = 'none';
    console.log('[initializeCustomCodeMirrorTest] Original textarea is now hidden.');

    return editorView;
}


export async function initializeCustomCodeMirrorNew(textareaId, options) {
    console.log(`[initializeCustomCodeMirrorNew] Initializing new custom CodeMirror for textarea with ID: ${textareaId}`);
    const textarea = document.getElementById(textareaId);
    if (!textarea) {
        console.log(`[initializeCustomCodeMirrorNew] No textarea found with ID: ${textareaId}`);
        return null;
    }

    const basicExtensions = [basicSetup]; // Fügen Sie hier Ihre grundlegenden Erweiterungen hinzu
    console.log('[initializeCustomCodeMirrorNew] Basic extensions:', basicExtensions);

    const editorView = new EditorView({
        state: EditorState.create({
            doc: textarea.value,
            extensions: basicExtensions
        }),
        parent: textarea.parentNode
    });
    console.log('[initializeCustomCodeMirrorNew] EditorView created successfully.');

    textarea.style.display = 'none';
    console.log('[initializeCustomCodeMirrorNew] Original textarea is now hidden.');

    return editorView;
}

window.myCodeMirrorModule = { initializeCustomCodeMirrorTest, markTextByLines };
