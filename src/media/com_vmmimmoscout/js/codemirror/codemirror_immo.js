// codemirror_immo.js
import { StateEffect, Compartment } from "../../../vendor/codemirror/js/codemirror-state";
import { MarkSpecificLinesPlugin} from '../../js/codemirror/plugins/MarkSpecificLinesPlugin.js';


const markLinesCompartment = new Compartment();


export function markLinesInEditor(editorObject, linesToMark) {
    const editorView = editorObject?.instance; // Zugriff auf die Editor-Instanz
    if (!editorView) {
        console.error('[codemirror_immo] EditorView not found for editorObject:', editorObject);
        return;
    }

    const effects = [];
    linesToMark.forEach(line => {
        // Berechne die Positionen für den Anfang und das Ende der Zeile
        const from = editorView.state.doc.line(line).from;
        const to = editorView.state.doc.line(line).to;
        effects.push(addMarkedLines.of({from, to}));
    });

    // Füge das Zustandsfeld hinzu, wenn es noch nicht vorhanden ist, und wende die Effekte an
    const fieldExists = editorView.state.field(markedLinesField, false);
    if (!fieldExists) {
        effects.push(StateEffect.appendConfig.of([markedLinesField]));
    }

    editorView.dispatch({effects});
}



/*
export function markLinesInEditor(editorObject, linesToMark) {
    const editorView = editorObject?.instance; // Stelle sicher, dass wir auf die Instanz-Eigenschaft zugreifen
    console.log('editorView: ', editorView );

    if (!editorView) {
        console.error('[codemirror_immo] EditorView not found for editorObject:', editorObject);
        return; // Beende die Funktion, wenn kein EditorView gefunden wurde
    }

    console.error('[codemirror_immo] EditorView found for editorObject:', editorObject);
    console.log('[codemirror_immo] markLinesInEditor called with lines:', linesToMark);



    // Erstelle die Plugin-Extension mit der statischen Methode create der MarkSpecificLinesPlugin-Klasse
    const pluginExtension = MarkSpecificLinesPlugin.create(editorView, linesToMark);

    console.log('[codemirror_immo] Dispatching plugin to editorView...');
    console.log('EditorPluginsBeforeDispatch: ', editorView.plugins );
    console.log('pluginExtension: ', pluginExtension );
    console.log('EditorStateBeforeDispatch: ', editorView.state );

    editorView.dispatch({
        effects: StateEffect.appendConfig.of([pluginExtension])
    });
    console.log('EditorPluginsAfterDispatch: ', editorView.plugins );

    console.log('LastEditorState: ', editorView.state );

    console.log('[codemirror_immo] Plugin dispatched to editorView.');
}
*/


/*
export function markLinesInEditor(editorObject, linesToMark) {
    const editorView = editorObject?.instance; // Stelle sicher, dass wir auf die Instanz-Eigenschaft zugreifen
    console.log('editorView: ', editorView );

    if (!editorView) {
        console.error('[codemirror_immo] EditorView not found for editorObject:', editorObject);
        return; // Beende die Funktion, wenn kein EditorView gefunden wurde
    }

    console.error('[codemirror_immo] EditorView found for editorObject:', editorObject);
    console.log('[codemirror_immo] markLinesInEditor called with lines:', linesToMark);



    // Erstelle die Plugin-Extension mit der statischen Methode create der MarkSpecificLinesPlugin-Klasse
    const pluginExtension = MarkSpecificLinesPlugin.create(editorView, linesToMark);

    console.log('[codemirror_immo] Dispatching plugin to editorView...');
    console.log('EditorPluginsBeforeDispatch: ', editorView.plugins );
    console.log('pluginExtension: ', pluginExtension );
    console.log('EditorStateBeforeDispatch: ', editorView.state );

    editorView.dispatch({
        effects: StateEffect.appendConfig.of([pluginExtension])
    });
    console.log('EditorPluginsAfterDispatch: ', editorView.plugins );

    console.log('LastEditorState: ', editorView.state );

    console.log('[codemirror_immo] Plugin dispatched to editorView.');
}
*/
