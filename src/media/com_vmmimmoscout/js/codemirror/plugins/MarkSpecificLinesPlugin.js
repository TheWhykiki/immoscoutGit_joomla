// MarkSpecificLinesPlugin.js
import { Decoration, ViewPlugin } from "../../../../../../media/vendor/codemirror/js/codemirror-view";

export class MarkSpecificLinesPlugin {
    static create(view, linesToMark) {
        // Initialisiere die Dekorationen, wenn das Plugin erstellt wird
        const decorations = this.createDecorations(view, linesToMark);
        console.log('[MarkSpecificLinesPlugin] Plugin created, linesToMark:', linesToMark, decorations);

        // Definiere das Verhalten des Plugins
        return ViewPlugin.fromClass(class {
            constructor(view) {
                this.decorations = decorations;
                console.log('[MarkSpecificLinesPlugin] Constructor called, initial decorations:', this.decorations);
            }

            update(update) {
                if (update.docChanged || update.viewportChanged) {
                    this.decorations = MarkSpecificLinesPlugin.createDecorations(update.view, linesToMark);
                    console.log('[MarkSpecificLinesPlugin] Update called, decorations updated:', this.decorations);
                }
            }
        }, {
            decorations: v => v.decorations
        });
    }

    static createDecorations(view, linesToMark) {
        let decorations = [];
        console.log(`[MarkSpecificLinesPlugin] Creating decorations for lines:`, linesToMark);
        for (let lineNum of linesToMark) {
            const lineDecoration = Decoration.line({ class: 'markedLine' });
            const line = view.state.doc.line(lineNum + 1); // Get the actual line
            decorations.push(lineDecoration.range(line.from));
            console.log(`[MarkSpecificLinesPlugin] Decoration for line ${lineNum + 1} created:`, line.from);
        }
        return Decoration.set(decorations);
    }
}
