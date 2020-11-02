// import external dependencies
import 'jquery';
import ponudnikiAdd from "./admin/ponudniki/ponudnikiAdd";
import ponudnikiEdit from "./admin/ponudniki/ponudnikiEdit";
import ponudnikiKontakt from "./admin/ponudniki/ponudnikiKontakt";
import izdelkiAdd from "./admin/izdelki/izdelkiAdd";
import izdelkiEdit from "./admin/izdelki/izdelkiEdit";

jQuery(document).ready(() => {
    ponudnikiAdd();
    ponudnikiEdit();
    izdelkiAdd();
    izdelkiEdit();
    ponudnikiKontakt();
});
