import { _ as _sfc_main$1 } from "./AppHead-BIk402Lz.js";
import { useSSRContext } from "vue";
import { ssrRenderComponent } from "vue/server-renderer";
import { _ as _export_sfc } from "../ssr.js";
import "@inertiajs/vue3";
import "@vueuse/core";
import "@heroicons/vue/20/solid";
import "axios";
import "vue-demi";
import "@heroicons/vue/24/solid";
import "@headlessui/vue";
import "@heroicons/vue/24/outline";
import "ziggy-js";
import "dayjs";
import "dayjs/plugin/advancedFormat.js";
import "dayjs/plugin/customParseFormat.js";
import "dayjs/plugin/dayOfYear.js";
import "dayjs/plugin/duration.js";
import "dayjs/plugin/isBetween.js";
import "dayjs/plugin/isSameOrAfter.js";
import "dayjs/plugin/isSameOrBefore.js";
import "dayjs/plugin/isToday.js";
import "dayjs/plugin/isTomorrow.js";
import "dayjs/plugin/isYesterday.js";
import "dayjs/plugin/isoWeek.js";
import "dayjs/plugin/localizedFormat.js";
import "dayjs/plugin/objectSupport.js";
import "dayjs/plugin/pluralGetSet.js";
import "dayjs/plugin/relativeTime.js";
import "dayjs/plugin/timezone.js";
import "dayjs/plugin/utc.js";
import "dayjs/plugin/weekday.js";
import "@inertiajs/vue3/server";
import "@vue/server-renderer";
const _sfc_main = {};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs) {
  const _component_AppHead = _sfc_main$1;
  _push(`<!--[-->`);
  _push(ssrRenderComponent(_component_AppHead, { title: "About" }, null, _parent));
  _push(`<div class="prose mx-auto max-w-7xl p-4 pt-8 dark:text-white"></div><!--]-->`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/about.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const about = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  about as default
};
