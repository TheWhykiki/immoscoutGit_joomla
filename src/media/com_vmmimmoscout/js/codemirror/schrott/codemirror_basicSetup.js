// Standard-Tastenkombinationen und Befehle
import { defaultKeymap } from "../../../vendor/codemirror/js/codemirror-commands";

// Such- und Ersetzungsfunktionen
import { searchKeymap } from "../../../vendor/codemirror/js/codemirror-search";

import {php} from "../../../vendor/codemirror/js/codemirror-lang-php";
import {css} from "../../../vendor/codemirror/js/codemirror-lang-css";
import {javascript} from "../../../vendor/codemirror/js/codemirror-lang-javascript";
import {xml} from "../../../vendor/codemirror/js/codemirror-lang-xml";
import {json} from "../../../vendor/codemirror/js/codemirror-lang-json";

// Autokomplettierungsfunktionen
import { autocompletion, completionKeymap } from "../../../vendor/codemirror/js/codemirror-autocomplete";

// Linting (Fehlerüberprüfung)
import { lintKeymap } from "../../../vendor/codemirror/js/codemirror-lint";

// Erstellen Sie Ihre eigene Basis-Setup-Konfiguration
export const basicSetup = [
    defaultKeymap,
    searchKeymap,
    autocompletion,
    completionKeymap,
    lintKeymap,
    php(),
    css(),
    javascript(),
    xml(),
    json(),

    console.log("CodeMirror Basic Setup Script geladen.")
];
