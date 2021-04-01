// import external dependencies
import 'jquery';

import ponudnikiAdd from "./admin/ponudniki/ponudnikiAdd";
import ponudnikiEdit from "./admin/ponudniki/ponudnikiEdit";
import izdelkiAdd from "./admin/izdelki/izdelkiAdd";
import izdelkiEdit from "./admin/izdelki/izdelkiEdit";
import editor from "./admin/editor";
import pomoc from "./admin/pomoc";
import turisticniPonudnikiAdd from "./admin/turisticni-ponudniki/turisticniPonudnikiAdd";
import turisticniPonudnikiEdit from "./admin/turisticni-ponudniki/turisticniPonudnikiEdit";
import nastanitveAdd from "./admin/nastanitve/nastanitveAdd";
import nastanitveEdit from "./admin/nastanitve/nastanitveEdit";

jQuery(document).ready(() => {
    ponudnikiAdd();
    ponudnikiEdit();
    izdelkiAdd();
    izdelkiEdit();
    turisticniPonudnikiAdd();
    turisticniPonudnikiEdit();
    nastanitveAdd();
    nastanitveEdit();
    editor();
    pomoc();
});
