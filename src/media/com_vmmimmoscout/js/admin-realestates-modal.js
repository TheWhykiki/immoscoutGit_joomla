/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/
(() => {
  /**
    * Javascript to insert the link
    * View element calls jSelectDummy when a dummy is clicked
    * jSelectDummy creates the link tag, sends it to the editor,
    * and closes the select frame.
    */

  window.jSelectDummy = (id, title, catid, object, link, lang) => {
    let hreflang = '';

    if (!Joomla.getOptions('xtd-dummies')) {
      // Something went wrong
      window.parent.Joomla.Modal.getCurrent().close();
      return false;
    }

    const {
      editor
    } = Joomla.getOptions('xtd-dummies');

    if (lang !== '') {
      hreflang = `hreflang = "${lang}"`;
    }

    const tag = `<a ${hreflang}  href="${link}">${title}</a>`;
    window.parent.Joomla.editors.instances[editor].replaceSelection(tag);
    window.parent.Joomla.Modal.getCurrent().close();
    return true;
  };

  document.addEventListener('DOMContentLoaded', () => {
    // Get the elements
    const elements = document.querySelectorAll('.select-link');

    for (let i = 0, l = elements.length; l > i; i += 1) {
      // Listen for click event
      elements[i].addEventListener('click', event => {
        event.preventDefault();
        const functionName = event.target.getAttribute('data-function');

        if (functionName === 'jSelectDummy') {
          // Used in xtd_dummies
          window[functionName](event.target.getAttribute('data-id'), event.target.getAttribute('data-title'), null, null, event.target.getAttribute('data-uri'), event.target.getAttribute('data-language'), null);
        } else {
          // Used in com_menus
          window.parent[functionName](event.target.getAttribute('data-id'), event.target.getAttribute('data-title'), null, null, event.target.getAttribute('data-uri'), event.target.getAttribute('data-language'), null);
        }

        if (window.parent.Joomla.Modal) {
          window.parent.Joomla.Modal.getCurrent().close();
        }
      });
    }
  });
})();
