import { Link } from "@inertiajs/vue3";
import { _ as _sfc_main$1 } from "./AppHead-BIk402Lz.js";
import "../ssr.js";
import { mergeProps, unref, withCtx, createTextVNode, toDisplayString, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrInterpolate, ssrRenderStyle } from "vue/server-renderer";
import dayjs from "dayjs";
import "@vueuse/core";
import "@heroicons/vue/20/solid";
import "axios";
import "vue-demi";
import "@heroicons/vue/24/solid";
import "@headlessui/vue";
import "@heroicons/vue/24/outline";
import "ziggy-js";
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
const _sfc_main = {
  __name: "view",
  __ssrInlineRender: true,
  props: {
    article: { type: Object, required: true }
  },
  setup(__props) {
    function getPercentage(value) {
      return 100 * value / 10;
    }
    return (_ctx, _push, _parent, _attrs) => {
      const _component_AppHead = _sfc_main$1;
      const _component_InertiaLink = Link;
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "w-full" }, _attrs))}>`);
      _push(ssrRenderComponent(_component_AppHead, {
        title: __props.article.title,
        author: __props.article.author.name,
        "author-twitter": __props.article.author.twitter ?? void 0,
        "og-type": "article",
        description: __props.article.excerpt,
        "published-at": ("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))(__props.article.published_at).toISOString(),
        "updated-at": ("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))(__props.article.updated_at).toISOString()
      }, null, _parent));
      _push(`<div class="hero-banner"><img src="https://via.placeholder.com/800x400" loading="lazy" decoding="async" class="absolute h-full w-full object-cover" alt=""><div class="hero-copy space-y-4"><h1>${ssrInterpolate(__props.article.title)}</h1><p> By `);
      _push(ssrRenderComponent(_component_InertiaLink, {
        href: `/author/${__props.article.author.slug}`
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`${ssrInterpolate(__props.article.author.name)}`);
          } else {
            return [
              createTextVNode(toDisplayString(__props.article.author.name), 1)
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(` on ${ssrInterpolate(("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))(__props.article.published_at).format("DD/MM/YYYY HH:mm z"))}</p><div class="scroll-indicator"><span></span></div></div></div><div class="prose mx-auto max-w-7xl p-4 pt-8 dark:text-white">${__props.article.content}</div>`);
      if (__props.article.review) {
        _push(`<div class="mx-auto flex max-w-6xl items-center gap-6 rounded-md bg-base-100/20 p-4 shadow dark:bg-neutral"><div class="hexagon h-[180px] w-[200px] text-6xl">${ssrInterpolate(__props.article.review.overall)}</div><div class="flex flex-1 flex-col gap-y-4"><p class="text-center text-xl font-semibold italic"> “${ssrInterpolate(__props.article.review.oneliner)}” </p>`);
        if (__props.article.review.quote) {
          _push(`<div class="prose w-full max-w-full dark:text-base-content">${__props.article.review.quote}</div>`);
        } else {
          _push(`<!---->`);
        }
        _push(`<div><div class="mb-1 flex justify-between"><span class="text-base font-medium dark:text-white">Story</span><span class="text-sm font-medium dark:text-white">${ssrInterpolate(getPercentage(__props.article.review.story))}% </span></div><div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700"><div class="h-2.5 rounded-full bg-indigo-500" style="${ssrRenderStyle({ width: `${getPercentage(__props.article.review.story)}%` })}"></div></div></div><div><div class="mb-1 flex justify-between"><span class="text-base font-medium dark:text-white">Gameplay</span><span class="text-sm font-medium dark:text-white">${ssrInterpolate(getPercentage(__props.article.review.gameplay))}% </span></div><div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700"><div class="h-2.5 rounded-full bg-indigo-500" style="${ssrRenderStyle({ width: `${getPercentage(__props.article.review.gameplay)}%` })}"></div></div></div><div><div class="mb-1 flex justify-between"><span class="text-base font-medium dark:text-white">Graphics</span><span class="text-sm font-medium dark:text-white">${ssrInterpolate(getPercentage(__props.article.review.graphics))}% </span></div><div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700"><div class="h-2.5 rounded-full bg-indigo-500" style="${ssrRenderStyle({ width: `${getPercentage(__props.article.review.graphics)}%` })}"></div></div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      _push(`</div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/news/view.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
