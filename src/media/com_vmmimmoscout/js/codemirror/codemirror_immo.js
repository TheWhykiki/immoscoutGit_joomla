// codemirror_immo.js
import { StateEffect, Compartment } from "../../../vendor/codemirror/js/codemirror-state";
import { MarkSpecificLinesPlugin } from "./plugins/MarkSpecificLinesPlugin";  // Pfad anpassen
const markLinesCompartment = new Compartment();

export function markLinesInEditor(editorObject, linesToMark) {
    const editorView = editorObject?.instance; // Zugriff auf die Editor-Instanz
    if (!editorView) {
        console.error('[codemirror_immo] EditorView not found for editorObject:', editorObject);
        return;
    }

    console.log('editorViewVorPLugin: ', editorView );
    console.log('EditorPluginsBeforeDispatch: ', editorView.plugins );
    console.log('EditorStateBeforeDispatch: ', editorView.state );

    const newPlugin = MarkSpecificLinesPlugin.create(editorView, linesToMark);

    // Hier verwenden wir das Compartment, um das Plugin zu aktualisieren
    editorView.dispatch({
        effects: markLinesCompartment.reconfigure(newPlugin)
    });

    console.log('editorViewNachPLugin: ', editorView );
    console.log('EditorPluginsAfterDispatch: ', editorView.plugins );
    console.log('EditorStateAfterDispatch: ', editorView.state );

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
