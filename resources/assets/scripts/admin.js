// import external dependencies
import 'jquery';
import ponudnikiAdd from "./admin/ponudniki/ponudnikiAdd";
import ponudnikiEdit from "./admin/ponudniki/ponudnikiEdit";
import ponudnikiKontakt from "./admin/ponudniki/ponudnikiKontakt";

jQuery(document).ready(() => {
    ponudnikiAdd();
    ponudnikiEdit();
    ponudnikiKontakt();
});
