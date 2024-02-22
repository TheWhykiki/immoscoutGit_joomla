// MarkSpecificLinesPlugin.js
import { Decoration, ViewPlugin } from "../../../../../../media/vendor/codemirror/js/codemirror-view";

// Definiere einen Zustandseffekt, um Zeilen hinzuzufügen, die markiert werden sollen
const addMarkedLines = StateEffect.define({map: (value, mapping) => ({from: mapping.mapPos(value.from), to: mapping.mapPos(value.to)})});

// Definiere ein Zustandsfeld, um die markierten Zeilen zu speichern
const MarkSpecificLinesPlugin = StateField.define({
    create() {
        return Decoration.none;
    },
    update(markedLines, tr) {
        markedLines = markedLines.map(tr.changes);
        for (let effect of tr.effects) {
            if (effect.is(addMarkedLines)) {
                const {from, to} = effect.value;
                markedLines = markedLines.update({add: [Decoration.line({class: "cm-markedLine"}).range(from, to)]});
            }
        }
        return markedLines;
    },
    provide: f => EditorView.decorations.from(f)
});

const markedLineDecoration = Decoration.line({class: "cm-markedLine"});
