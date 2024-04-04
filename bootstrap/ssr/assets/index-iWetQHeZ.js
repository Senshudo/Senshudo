import { useSSRContext, reactive, watch, mergeProps, unref, computed } from "vue";
import { ssrRenderAttrs, ssrRenderClass, ssrInterpolate, ssrRenderComponent, ssrRenderList, ssrRenderAttr } from "vue/server-renderer";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/24/solid";
import { _ as _sfc_main$3, a as _sfc_main$4 } from "./FeaturedSection-BISHdNsM.js";
import { _ as _sfc_main$2 } from "./AppHead-BIk402Lz.js";
import { route } from "ziggy-js";
import { router } from "@inertiajs/vue3";
import "../ssr.js";
import "@vueuse/core";
import "@heroicons/vue/20/solid";
import "axios";
import "vue-demi";
import "@headlessui/vue";
import "@heroicons/vue/24/outline";
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
function navigateTo(url, options = {}) {
  router.visit(url, options);
}
function useFormatNumber(value, options) {
  return Intl.NumberFormat(
    typeof navigator !== "undefined" ? navigator.language : "en-GB",
    options
  ).format(value);
}
const _sfc_main$1 = {
  __name: "Pagination",
  __ssrInlineRender: true,
  props: {
    meta: {
      type: Object,
      required: true
    },
    range: {
      type: Number,
      default: 10
    }
  },
  emits: ["page-change"],
  setup(__props, { emit: __emit }) {
    const props = __props;
    const data = reactive({
      page: {
        first: 1,
        current: 1,
        previous: 0,
        next: 0,
        last: 0,
        min: 0,
        max: 0,
        range: []
      }
    });
    watch(() => props.meta, calcPageRange, { deep: true, immediate: true });
    function calcPageRange() {
      var _a, _b, _c, _d, _e;
      let previousPage = ((_a = props.meta) == null ? void 0 : _a.current_page) - 1;
      let nextPage = ((_b = props.meta) == null ? void 0 : _b.current_page) + 1;
      const maxPagesBeforeCurrentPage = Math.floor(props.range / 2);
      const maxPagesAfterCurrentPage = Math.floor(props.range / 2) - 1;
      if (previousPage < 1) {
        previousPage = 0;
      }
      if (nextPage > ((_c = props.meta) == null ? void 0 : _c.last_page)) {
        nextPage = 0;
      }
      data.page.current = (_d = props.meta) == null ? void 0 : _d.current_page;
      data.page.previous = previousPage;
      data.page.next = nextPage;
      data.page.last = ((_e = props.meta) == null ? void 0 : _e.last_page) ?? 1;
      if (data.page.last <= props.range) {
        data.page.min = 1;
        data.page.max = data.page.last;
      } else if (data.page.current <= maxPagesBeforeCurrentPage) {
        data.page.min = 1;
        data.page.max = props.range;
      } else if (data.page.current + maxPagesAfterCurrentPage >= data.page.last) {
        data.page.min = data.page.last - props.range + 1;
        data.page.max = data.page.last;
      } else {
        data.page.min = data.page.current - maxPagesBeforeCurrentPage;
        data.page.max = data.page.current + maxPagesAfterCurrentPage;
      }
      data.page.range = Array.from(Array(data.page.max + 1 - data.page.min).keys()).map(
        (i) => data.page.min + i
      );
    }
    return (_ctx, _push, _parent, _attrs) => {
      var _a, _b, _c;
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "mt-6 flex w-full items-center justify-between border-t border-gray-300 pt-4" }, _attrs))}><div class="flex flex-1 justify-between sm:hidden"><button type="button" class="${ssrRenderClass([{ disabled: unref(data).page.current <= 1 && unref(data).page.previous === 0 }, "btn btn-default relative inline-flex"])}"> Previous </button><button type="button" class="${ssrRenderClass([{
        disabled: unref(data).page.current >= unref(data).page.last
      }, "btn btn-default relative inline-flex"])}"> Next </button></div><div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"><div><p class="text-sm text-gray-700 dark:text-base-content"> Showing ${ssrInterpolate(" ")} <span class="font-medium">${ssrInterpolate(("useFormatNumber" in _ctx ? _ctx.useFormatNumber : unref(useFormatNumber))((_a = __props.meta) == null ? void 0 : _a.from))}</span> ${ssrInterpolate(" ")} to ${ssrInterpolate(" ")} <span class="font-medium">${ssrInterpolate(("useFormatNumber" in _ctx ? _ctx.useFormatNumber : unref(useFormatNumber))((_b = __props.meta) == null ? void 0 : _b.to))}</span> ${ssrInterpolate(" ")} of ${ssrInterpolate(" ")} <span class="font-medium">${ssrInterpolate(("useFormatNumber" in _ctx ? _ctx.useFormatNumber : unref(useFormatNumber))((_c = __props.meta) == null ? void 0 : _c.total))}</span> ${ssrInterpolate(" ")} results </p></div><div><nav class="relative z-0 inline-flex space-x-1.5 rounded-md shadow-sm" aria-label="Pagination"><button type="button" class="${ssrRenderClass([{ disabled: unref(data).page.current <= 1 && unref(data).page.previous === 0 }, "btn btn-sm btn-default relative inline-flex"])}"><span class="sr-only">Previous</span>`);
      _push(ssrRenderComponent(unref(ChevronLeftIcon), {
        class: "h-5 w-5",
        "aria-hidden": "true"
      }, null, _parent));
      _push(`</button><!--[-->`);
      ssrRenderList(unref(data).page.range, (p) => {
        _push(`<button type="button"${ssrRenderAttr("aria-current", unref(data).page.current === p ? "page" : void 0)} class="${ssrRenderClass([{
          "btn-primary z-10": unref(data).page.current === p,
          "btn-default z-10": unref(data).page.current !== p
        }, "btn btn-sm relative inline-flex items-center"])}">${ssrInterpolate(("useFormatNumber" in _ctx ? _ctx.useFormatNumber : unref(useFormatNumber))(p))}</button>`);
      });
      _push(`<!--]--><button type="button" class="${ssrRenderClass([{
        disabled: unref(data).page.current >= unref(data).page.last
      }, "btn btn-sm btn-default relative inline-flex"])}"><span class="sr-only">Next</span>`);
      _push(ssrRenderComponent(unref(ChevronRightIcon), {
        class: "h-5 w-5",
        "aria-hidden": "true"
      }, null, _parent));
      _push(`</button></nav></div></div></div>`);
    };
  }
};
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/Pagination.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {
  __name: "index",
  __ssrInlineRender: true,
  props: {
    articles: {
      type: Object,
      required: true
    }
  },
  setup(__props) {
    const props = __props;
    const pageTitle = computed(() => {
      var _a, _b;
      const pageName = route().current("news.index") ? "News" : "Reviews";
      if (((_b = (_a = props.articles) == null ? void 0 : _a.meta) == null ? void 0 : _b.current_page) > 1) {
        return `${pageName} - Page ${props.articles.meta.current_page}`;
      }
      return pageName;
    });
    function goToPage(page) {
      navigateTo(route().current("news.index") ? `/news?page=${page}` : `/reviews?page=${page}`);
    }
    return (_ctx, _push, _parent, _attrs) => {
      const _component_AppHead = _sfc_main$2;
      const _component_articles_featured_section = _sfc_main$3;
      const _component_articles_card = _sfc_main$4;
      const _component_pagination = _sfc_main$1;
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "mx-auto max-w-7xl p-4" }, _attrs))}>`);
      _push(ssrRenderComponent(_component_AppHead, { title: unref(pageTitle) }, null, _parent));
      _push(ssrRenderComponent(_component_articles_featured_section, {
        articles: __props.articles.data.length > 0 ? __props.articles.data.filter((article, index) => index >= 0 && index < 5) : []
      }, null, _parent));
      _push(`<div class="mb-4 mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4"><!--[-->`);
      ssrRenderList(__props.articles.data.slice(5), (article) => {
        _push(ssrRenderComponent(_component_articles_card, {
          key: article.id,
          article
        }, null, _parent));
      });
      _push(`<!--]--></div>`);
      _push(ssrRenderComponent(_component_pagination, {
        meta: __props.articles.meta,
        onPageChange: goToPage
      }, null, _parent));
      _push(`</div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/news/index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
