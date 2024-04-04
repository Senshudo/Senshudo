import { _ as _sfc_main$4, a as _sfc_main$5 } from "./FeaturedSection-BISHdNsM.js";
import { Link } from "@inertiajs/vue3";
import "../ssr.js";
import { useSSRContext, mergeProps, withCtx, unref, createVNode, openBlock, createBlock, createCommentVNode, toDisplayString } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderAttr, ssrInterpolate, ssrRenderList } from "vue/server-renderer";
import dayjs from "dayjs";
import { _ as _sfc_main$3 } from "./LiveStream-nQSKXxpT.js";
import { _ as _sfc_main$2 } from "./AppHead-BIk402Lz.js";
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
import "laravel-echo";
import "pusher-js";
const _sfc_main$1 = {
  __name: "Featured",
  __ssrInlineRender: true,
  props: {
    article: {
      type: Object,
      required: true
    },
    isLoading: {
      type: Boolean,
      default: false
    }
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      const _component_InertiaLink = Link;
      _push(`<article${ssrRenderAttrs(mergeProps({ class: "relative my-4 w-full overflow-hidden" }, _attrs))}>`);
      if (__props.isLoading) {
        _push(`<div class="flex flex-col"><div class="relative flex h-full w-auto transform-none flex-col items-end justify-center"><div class="h-[500px] w-[900px] rounded bg-gray-300"></div></div><div class="absolute top-1/2 z-[2] h-full w-full -translate-y-1/2 bg-white blur-lg dark:bg-base-100/30 sm:w-1/2"></div><div class="absolute top-[80%] z-[3] flex w-full -translate-y-1/2 animate-pulse flex-col gap-4 p-2 dark:text-white sm:top-1/2 sm:w-1/2"><div class="h-6 rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 w-1/2 rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 rounded bg-base-100/30 dark:bg-slate-700"></div></div></div>`);
      } else {
        _push(ssrRenderComponent(_component_InertiaLink, {
          class: "flex flex-col",
          href: `/news/${__props.article.slug}`
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            var _a, _b;
            if (_push2) {
              _push2(`<div class="relative flex h-full w-auto transform-none flex-col items-end justify-center"${_scopeId}><div class="relative h-[500px] w-[900px] rounded bg-gray-300"${_scopeId}>`);
              if (__props.article.thumbnail) {
                _push2(`<img${ssrRenderAttr("src", __props.article.thumbnail)} loading="lazy" decoding="async" alt="Placeholder" class="h-full w-full rounded object-cover"${_scopeId}>`);
              } else {
                _push2(`<!---->`);
              }
              if (__props.article.review) {
                _push2(`<div class="hexagon absolute right-2 top-2 w-[50px]"${_scopeId}><div${_scopeId}>${ssrInterpolate(__props.article.review.overall)}</div></div>`);
              } else {
                _push2(`<!---->`);
              }
              _push2(`</div></div><div class="absolute top-1/2 z-[2] h-full w-full -translate-y-1/2 bg-white blur-lg dark:bg-base-100/30 sm:w-1/2"${_scopeId}></div><div class="absolute top-1/2 z-[3] flex w-full -translate-y-1/2 flex-col gap-4 p-2 dark:text-white sm:w-1/2"${_scopeId}><h2 class="font-blac text-nowrapk mb-2 overflow-hidden text-ellipsis text-5xl"${_scopeId}>${__props.article.title}</h2><div class="flex flex-row gap-4"${_scopeId}><div class="border-l-4 border-red-600 pl-2"${_scopeId}>${ssrInterpolate((_a = __props.article.author) == null ? void 0 : _a.name)}</div><div class="border-l-4 border-red-600 pl-2"${_scopeId}>${ssrInterpolate(("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))(__props.article.published_at).format("DD/MM/YYYY HH:mm z"))}</div></div><p${_scopeId}>${__props.article.excerpt}</p></div>`);
            } else {
              return [
                createVNode("div", { class: "relative flex h-full w-auto transform-none flex-col items-end justify-center" }, [
                  createVNode("div", { class: "relative h-[500px] w-[900px] rounded bg-gray-300" }, [
                    __props.article.thumbnail ? (openBlock(), createBlock("img", {
                      key: 0,
                      src: __props.article.thumbnail,
                      loading: "lazy",
                      decoding: "async",
                      alt: "Placeholder",
                      class: "h-full w-full rounded object-cover"
                    }, null, 8, ["src"])) : createCommentVNode("", true),
                    __props.article.review ? (openBlock(), createBlock("div", {
                      key: 1,
                      class: "hexagon absolute right-2 top-2 w-[50px]"
                    }, [
                      createVNode("div", null, toDisplayString(__props.article.review.overall), 1)
                    ])) : createCommentVNode("", true)
                  ])
                ]),
                createVNode("div", { class: "absolute top-1/2 z-[2] h-full w-full -translate-y-1/2 bg-white blur-lg dark:bg-base-100/30 sm:w-1/2" }),
                createVNode("div", { class: "absolute top-1/2 z-[3] flex w-full -translate-y-1/2 flex-col gap-4 p-2 dark:text-white sm:w-1/2" }, [
                  createVNode("h2", {
                    class: "font-blac text-nowrapk mb-2 overflow-hidden text-ellipsis text-5xl",
                    innerHTML: __props.article.title
                  }, null, 8, ["innerHTML"]),
                  createVNode("div", { class: "flex flex-row gap-4" }, [
                    createVNode("div", { class: "border-l-4 border-red-600 pl-2" }, toDisplayString((_b = __props.article.author) == null ? void 0 : _b.name), 1),
                    createVNode("div", { class: "border-l-4 border-red-600 pl-2" }, toDisplayString(("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))(__props.article.published_at).format("DD/MM/YYYY HH:mm z")), 1)
                  ]),
                  createVNode("p", {
                    innerHTML: __props.article.excerpt
                  }, null, 8, ["innerHTML"])
                ])
              ];
            }
          }),
          _: 1
        }, _parent));
      }
      _push(`</article>`);
    };
  }
};
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/Articles/Featured.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {
  __name: "index",
  __ssrInlineRender: true,
  props: {
    featured: {
      type: Object,
      required: true
    },
    articles: {
      type: Object,
      required: true
    }
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      const _component_AppHead = _sfc_main$2;
      const _component_LiveStream = _sfc_main$3;
      const _component_ArticlesFeatured = _sfc_main$1;
      const _component_ArticlesFeaturedSection = _sfc_main$4;
      const _component_ArticlesCard = _sfc_main$5;
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "mx-auto max-w-7xl p-4" }, _attrs))}>`);
      _push(ssrRenderComponent(_component_AppHead, null, null, _parent));
      _push(ssrRenderComponent(_component_LiveStream, null, null, _parent));
      _push(ssrRenderComponent(_component_ArticlesFeatured, {
        article: __props.featured.data.at(0)
      }, null, _parent));
      _push(ssrRenderComponent(_component_ArticlesFeaturedSection, {
        articles: __props.featured.data.slice(1)
      }, null, _parent));
      _push(`<div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4"><!--[-->`);
      ssrRenderList(12, (index) => {
        _push(ssrRenderComponent(_component_ArticlesCard, {
          key: `news${index}`,
          article: __props.articles.data.at(index)
        }, null, _parent));
      });
      _push(`<!--]--></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
