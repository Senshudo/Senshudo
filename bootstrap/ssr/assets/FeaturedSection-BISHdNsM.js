import { Link } from "@inertiajs/vue3";
import "../ssr.js";
import { useSSRContext, mergeProps, withCtx, unref, createVNode, openBlock, createBlock, toDisplayString, createCommentVNode } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderAttr, ssrInterpolate } from "vue/server-renderer";
import dayjs from "dayjs";
const _sfc_main$1 = {
  __name: "Card",
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
      _push(`<article${ssrRenderAttrs(mergeProps({ class: "flex overflow-hidden rounded bg-white shadow dark:bg-neutral" }, _attrs))}>`);
      if (__props.isLoading) {
        _push(`<div class="flex w-full flex-col"><div class="h-[154px] w-full bg-gray-300"></div><div class="flex flex-col gap-2 p-2"><div class="h-6 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="flex flex-row justify-between gap-x-4 text-sm"><div class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div></div><div class="h-2 w-full animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-2 w-full animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-2 w-full animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-2 w-full animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div></div></div>`);
      } else {
        _push(ssrRenderComponent(_component_InertiaLink, {
          href: `/news/${__props.article.slug}`,
          class: "flex w-full flex-col"
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            var _a, _b;
            if (_push2) {
              _push2(`<div class="relative"${_scopeId}><img${ssrRenderAttr(
                "src",
                __props.article.thumbnail ? __props.article.thumbnail : "https://via.placeholder.com/800x400"
              )} loading="lazy" decoding="async" alt="Placeholder" class="w-full object-cover"${_scopeId}>`);
              if (__props.article.review) {
                _push2(`<div class="hexagon absolute right-2 top-2 w-[50px]"${_scopeId}><div${_scopeId}>${ssrInterpolate(__props.article.review.overall)}</div></div>`);
              } else {
                _push2(`<!---->`);
              }
              _push2(`</div><div class="flex flex-col gap-2 p-2"${_scopeId}><h2 class="overflow-hidden text-ellipsis text-nowrap font-semibold"${_scopeId}>${__props.article.title}</h2><div class="flex flex-row justify-between gap-x-4 text-sm"${_scopeId}><div class="border-l-2 border-red-600 pl-1"${_scopeId}>${ssrInterpolate((_a = __props.article.author) == null ? void 0 : _a.name)}</div><div class="border-l-2 border-red-600 pl-1"${_scopeId}>${ssrInterpolate(("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))(__props.article.published_at).format("DD/MM/YYYY"))}</div></div><p class="text-sm"${_scopeId}>${__props.article.excerpt}</p></div>`);
            } else {
              return [
                createVNode("div", { class: "relative" }, [
                  createVNode("img", {
                    src: __props.article.thumbnail ? __props.article.thumbnail : "https://via.placeholder.com/800x400",
                    loading: "lazy",
                    decoding: "async",
                    alt: "Placeholder",
                    class: "w-full object-cover"
                  }, null, 8, ["src"]),
                  __props.article.review ? (openBlock(), createBlock("div", {
                    key: 0,
                    class: "hexagon absolute right-2 top-2 w-[50px]"
                  }, [
                    createVNode("div", null, toDisplayString(__props.article.review.overall), 1)
                  ])) : createCommentVNode("", true)
                ]),
                createVNode("div", { class: "flex flex-col gap-2 p-2" }, [
                  createVNode("h2", {
                    class: "overflow-hidden text-ellipsis text-nowrap font-semibold",
                    innerHTML: __props.article.title
                  }, null, 8, ["innerHTML"]),
                  createVNode("div", { class: "flex flex-row justify-between gap-x-4 text-sm" }, [
                    createVNode("div", { class: "border-l-2 border-red-600 pl-1" }, toDisplayString((_b = __props.article.author) == null ? void 0 : _b.name), 1),
                    createVNode("div", { class: "border-l-2 border-red-600 pl-1" }, toDisplayString(("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))(__props.article.published_at).format("DD/MM/YYYY")), 1)
                  ]),
                  createVNode("p", {
                    class: "text-sm",
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/Articles/Card.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {
  __name: "FeaturedSection",
  __ssrInlineRender: true,
  props: {
    articles: {
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
      var _a, _b, _c, _d, _e;
      const _component_InertiaLink = Link;
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "grid grid-cols-1 gap-y-1 lg:grid-cols-2 lg:gap-x-1 lg:gap-y-0" }, _attrs))}><article class="relative overflow-hidden rounded">`);
      if (__props.isLoading) {
        _push(`<div><div class="h-auto min-h-[319px] w-full rounded bg-gray-300 lg:max-w-[638px]"></div><div class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pb-4 pt-7"><div class="h-6 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div></div></div>`);
      } else {
        _push(ssrRenderComponent(_component_InertiaLink, {
          class: "block",
          href: `/news/${(_a = __props.articles.at(0)) == null ? void 0 : _a.slug}`
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            var _a2, _b2, _c2, _d2, _e2, _f, _g, _h, _i, _j, _k, _l;
            if (_push2) {
              _push2(`<img${ssrRenderAttr(
                "src",
                ((_a2 = __props.articles.at(0)) == null ? void 0 : _a2.thumbnail) ? (_b2 = __props.articles.at(0)) == null ? void 0 : _b2.thumbnail : "https://via.placeholder.com/800x400"
              )} loading="lazy" decoding="async" alt="Placeholder" class="mx-auto h-auto w-full max-w-full"${_scopeId}><div class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pb-4 pt-7"${_scopeId}><h2 class="mb-3 text-lg font-bold capitalize text-white lg:text-3xl"${_scopeId}>${(_c2 = __props.articles.at(0)) == null ? void 0 : _c2.title}</h2><div class="flex flex-row gap-x-4 pt-2 text-gray-100"${_scopeId}><div class="border-l-2 border-red-600 pl-1"${_scopeId}>${ssrInterpolate((_e2 = (_d2 = __props.articles.at(0)) == null ? void 0 : _d2.author) == null ? void 0 : _e2.name)}</div><div class="border-l-2 border-red-600 pl-1"${_scopeId}>${ssrInterpolate(("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))((_f = __props.articles.at(0)) == null ? void 0 : _f.published_at).format("DD/MM/YYYY HH:mm z"))}</div></div></div>`);
            } else {
              return [
                createVNode("img", {
                  src: ((_g = __props.articles.at(0)) == null ? void 0 : _g.thumbnail) ? (_h = __props.articles.at(0)) == null ? void 0 : _h.thumbnail : "https://via.placeholder.com/800x400",
                  loading: "lazy",
                  decoding: "async",
                  alt: "Placeholder",
                  class: "mx-auto h-auto w-full max-w-full"
                }, null, 8, ["src"]),
                createVNode("div", { class: "bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pb-4 pt-7" }, [
                  createVNode("h2", {
                    class: "mb-3 text-lg font-bold capitalize text-white lg:text-3xl",
                    innerHTML: (_i = __props.articles.at(0)) == null ? void 0 : _i.title
                  }, null, 8, ["innerHTML"]),
                  createVNode("div", { class: "flex flex-row gap-x-4 pt-2 text-gray-100" }, [
                    createVNode("div", { class: "border-l-2 border-red-600 pl-1" }, toDisplayString((_k = (_j = __props.articles.at(0)) == null ? void 0 : _j.author) == null ? void 0 : _k.name), 1),
                    createVNode("div", { class: "border-l-2 border-red-600 pl-1" }, toDisplayString(("useDayJs" in _ctx ? _ctx.useDayJs : unref(dayjs))((_l = __props.articles.at(0)) == null ? void 0 : _l.published_at).format("DD/MM/YYYY HH:mm z")), 1)
                  ])
                ])
              ];
            }
          }),
          _: 1
        }, _parent));
      }
      _push(`</article><div class="grid grid-cols-1 gap-1 sm:grid-cols-2"><article class="relative overflow-hidden rounded">`);
      if (__props.isLoading) {
        _push(`<div><div class="h-auto min-h-[158px] w-full rounded bg-gray-300 lg:max-w-[317px]"></div><div class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pb-4 pt-7"><div class="h-6 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div></div></div>`);
      } else {
        _push(ssrRenderComponent(_component_InertiaLink, {
          class: "block",
          href: `/news/${(_b = __props.articles.at(1)) == null ? void 0 : _b.slug}`
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            var _a2, _b2, _c2, _d2, _e2, _f, _g, _h, _i, _j;
            if (_push2) {
              _push2(`<img${ssrRenderAttr(
                "src",
                ((_a2 = __props.articles.at(1)) == null ? void 0 : _a2.thumbnail) ? (_b2 = __props.articles.at(1)) == null ? void 0 : _b2.thumbnail : "https://via.placeholder.com/800x400"
              )} loading="lazy" decoding="async" alt="Placeholder" class="mx-auto h-auto w-full max-w-full"${_scopeId}><div class="bg-gradient-cover absolute bottom-0 w-full px-4 pb-4 pt-7"${_scopeId}><h2 class="mb-1 text-lg font-bold capitalize leading-tight text-white"${_scopeId}>${(_c2 = __props.articles.at(1)) == null ? void 0 : _c2.title}</h2><div class="flex flex-row gap-x-4 pt-2 text-gray-100"${_scopeId}><div class="border-l-2 border-red-600 pl-1"${_scopeId}>${ssrInterpolate((_e2 = (_d2 = __props.articles.at(1)) == null ? void 0 : _d2.author) == null ? void 0 : _e2.name)}</div></div></div>`);
            } else {
              return [
                createVNode("img", {
                  src: ((_f = __props.articles.at(1)) == null ? void 0 : _f.thumbnail) ? (_g = __props.articles.at(1)) == null ? void 0 : _g.thumbnail : "https://via.placeholder.com/800x400",
                  loading: "lazy",
                  decoding: "async",
                  alt: "Placeholder",
                  class: "mx-auto h-auto w-full max-w-full"
                }, null, 8, ["src"]),
                createVNode("div", { class: "bg-gradient-cover absolute bottom-0 w-full px-4 pb-4 pt-7" }, [
                  createVNode("h2", {
                    class: "mb-1 text-lg font-bold capitalize leading-tight text-white",
                    innerHTML: (_h = __props.articles.at(1)) == null ? void 0 : _h.title
                  }, null, 8, ["innerHTML"]),
                  createVNode("div", { class: "flex flex-row gap-x-4 pt-2 text-gray-100" }, [
                    createVNode("div", { class: "border-l-2 border-red-600 pl-1" }, toDisplayString((_j = (_i = __props.articles.at(1)) == null ? void 0 : _i.author) == null ? void 0 : _j.name), 1)
                  ])
                ])
              ];
            }
          }),
          _: 1
        }, _parent));
      }
      _push(`</article><article class="relative overflow-hidden rounded">`);
      if (__props.isLoading) {
        _push(`<div><div class="min-h-[158px] w-full rounded bg-gray-300 lg:max-w-[317px]"></div><div class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pb-4 pt-7"><div class="h-6 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div></div></div>`);
      } else {
        _push(ssrRenderComponent(_component_InertiaLink, {
          class: "block",
          href: `/news/${(_c = __props.articles.at(2)) == null ? void 0 : _c.slug}`
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            var _a2, _b2, _c2, _d2, _e2, _f, _g, _h, _i, _j;
            if (_push2) {
              _push2(`<img${ssrRenderAttr(
                "src",
                ((_a2 = __props.articles.at(2)) == null ? void 0 : _a2.thumbnail) ? (_b2 = __props.articles.at(2)) == null ? void 0 : _b2.thumbnail : "https://via.placeholder.com/800x400"
              )} loading="lazy" decoding="async" alt="Placeholder" class="mx-auto h-auto w-full max-w-full"${_scopeId}><div class="bg-gradient-cover absolute bottom-0 w-full px-4 pb-4 pt-7"${_scopeId}><h2 class="mb-1 text-lg font-bold capitalize leading-tight text-white"${_scopeId}>${(_c2 = __props.articles.at(2)) == null ? void 0 : _c2.title}</h2><div class="flex flex-row gap-x-4 pt-2 text-gray-100"${_scopeId}><div class="border-l-2 border-red-600 pl-1"${_scopeId}>${ssrInterpolate((_e2 = (_d2 = __props.articles.at(2)) == null ? void 0 : _d2.author) == null ? void 0 : _e2.name)}</div></div></div>`);
            } else {
              return [
                createVNode("img", {
                  src: ((_f = __props.articles.at(2)) == null ? void 0 : _f.thumbnail) ? (_g = __props.articles.at(2)) == null ? void 0 : _g.thumbnail : "https://via.placeholder.com/800x400",
                  loading: "lazy",
                  decoding: "async",
                  alt: "Placeholder",
                  class: "mx-auto h-auto w-full max-w-full"
                }, null, 8, ["src"]),
                createVNode("div", { class: "bg-gradient-cover absolute bottom-0 w-full px-4 pb-4 pt-7" }, [
                  createVNode("h2", {
                    class: "mb-1 text-lg font-bold capitalize leading-tight text-white",
                    innerHTML: (_h = __props.articles.at(2)) == null ? void 0 : _h.title
                  }, null, 8, ["innerHTML"]),
                  createVNode("div", { class: "flex flex-row gap-x-4 pt-2 text-gray-100" }, [
                    createVNode("div", { class: "border-l-2 border-red-600 pl-1" }, toDisplayString((_j = (_i = __props.articles.at(2)) == null ? void 0 : _i.author) == null ? void 0 : _j.name), 1)
                  ])
                ])
              ];
            }
          }),
          _: 1
        }, _parent));
      }
      _push(`</article><article class="relative overflow-hidden rounded">`);
      if (__props.isLoading) {
        _push(`<div><div class="min-h-[158px] w-full rounded bg-gray-300 lg:max-w-[317px]"></div><div class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pb-4 pt-7"><div class="h-6 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div></div></div>`);
      } else {
        _push(ssrRenderComponent(_component_InertiaLink, {
          class: "block",
          href: `/news/${(_d = __props.articles.at(3)) == null ? void 0 : _d.slug}`
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            var _a2, _b2, _c2, _d2, _e2, _f, _g, _h, _i, _j;
            if (_push2) {
              _push2(`<img${ssrRenderAttr(
                "src",
                ((_a2 = __props.articles.at(3)) == null ? void 0 : _a2.thumbnail) ? (_b2 = __props.articles.at(3)) == null ? void 0 : _b2.thumbnail : "https://via.placeholder.com/800x400"
              )} loading="lazy" decoding="async" alt="Placeholder" class="mx-auto h-auto w-full max-w-full"${_scopeId}><div class="bg-gradient-cover absolute bottom-0 w-full px-4 pb-4 pt-7"${_scopeId}><h2 class="mb-1 text-lg font-bold capitalize leading-tight text-white"${_scopeId}>${(_c2 = __props.articles.at(3)) == null ? void 0 : _c2.title}</h2><div class="flex flex-row gap-x-4 pt-2 text-gray-100"${_scopeId}><div class="border-l-2 border-red-600 pl-1"${_scopeId}>${ssrInterpolate((_e2 = (_d2 = __props.articles.at(3)) == null ? void 0 : _d2.author) == null ? void 0 : _e2.name)}</div></div></div>`);
            } else {
              return [
                createVNode("img", {
                  src: ((_f = __props.articles.at(3)) == null ? void 0 : _f.thumbnail) ? (_g = __props.articles.at(3)) == null ? void 0 : _g.thumbnail : "https://via.placeholder.com/800x400",
                  loading: "lazy",
                  decoding: "async",
                  alt: "Placeholder",
                  class: "mx-auto h-auto w-full max-w-full"
                }, null, 8, ["src"]),
                createVNode("div", { class: "bg-gradient-cover absolute bottom-0 w-full px-4 pb-4 pt-7" }, [
                  createVNode("h2", {
                    class: "mb-1 text-lg font-bold capitalize leading-tight text-white",
                    innerHTML: (_h = __props.articles.at(3)) == null ? void 0 : _h.title
                  }, null, 8, ["innerHTML"]),
                  createVNode("div", { class: "flex flex-row gap-x-4 pt-2 text-gray-100" }, [
                    createVNode("div", { class: "border-l-2 border-red-600 pl-1" }, toDisplayString((_j = (_i = __props.articles.at(3)) == null ? void 0 : _i.author) == null ? void 0 : _j.name), 1)
                  ])
                ])
              ];
            }
          }),
          _: 1
        }, _parent));
      }
      _push(`</article><article class="relative overflow-hidden rounded">`);
      if (__props.isLoading) {
        _push(`<div><div class="min-h-[158px] w-full rounded bg-gray-300 lg:max-w-[317px]"></div><div class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pb-4 pt-7"><div class="h-6 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div><div class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div></div></div>`);
      } else {
        _push(ssrRenderComponent(_component_InertiaLink, {
          class: "block",
          href: `/news/${(_e = __props.articles.at(4)) == null ? void 0 : _e.slug}`
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            var _a2, _b2, _c2, _d2, _e2, _f, _g, _h, _i, _j;
            if (_push2) {
              _push2(`<img${ssrRenderAttr(
                "src",
                ((_a2 = __props.articles.at(4)) == null ? void 0 : _a2.thumbnail) ? (_b2 = __props.articles.at(4)) == null ? void 0 : _b2.thumbnail : "https://via.placeholder.com/800x400"
              )} loading="lazy" decoding="async" alt="Placeholder" class="mx-auto h-auto w-full max-w-full"${_scopeId}><div class="bg-gradient-cover absolute bottom-0 w-full px-4 pb-4 pt-7"${_scopeId}><h2 class="mb-1 overflow-hidden text-ellipsis text-nowrap text-lg font-bold capitalize leading-tight text-white"${_scopeId}>${(_c2 = __props.articles.at(4)) == null ? void 0 : _c2.title}</h2><div class="flex flex-row gap-x-4 pt-2 text-gray-100"${_scopeId}><div class="border-l-2 border-red-600 pl-1"${_scopeId}>${ssrInterpolate((_e2 = (_d2 = __props.articles.at(4)) == null ? void 0 : _d2.author) == null ? void 0 : _e2.name)}</div></div></div>`);
            } else {
              return [
                createVNode("img", {
                  src: ((_f = __props.articles.at(4)) == null ? void 0 : _f.thumbnail) ? (_g = __props.articles.at(4)) == null ? void 0 : _g.thumbnail : "https://via.placeholder.com/800x400",
                  loading: "lazy",
                  decoding: "async",
                  alt: "Placeholder",
                  class: "mx-auto h-auto w-full max-w-full"
                }, null, 8, ["src"]),
                createVNode("div", { class: "bg-gradient-cover absolute bottom-0 w-full px-4 pb-4 pt-7" }, [
                  createVNode("h2", {
                    class: "mb-1 overflow-hidden text-ellipsis text-nowrap text-lg font-bold capitalize leading-tight text-white",
                    innerHTML: (_h = __props.articles.at(4)) == null ? void 0 : _h.title
                  }, null, 8, ["innerHTML"]),
                  createVNode("div", { class: "flex flex-row gap-x-4 pt-2 text-gray-100" }, [
                    createVNode("div", { class: "border-l-2 border-red-600 pl-1" }, toDisplayString((_j = (_i = __props.articles.at(4)) == null ? void 0 : _i.author) == null ? void 0 : _j.name), 1)
                  ])
                ])
              ];
            }
          }),
          _: 1
        }, _parent));
      }
      _push(`</article></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/Articles/FeaturedSection.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as _,
  _sfc_main$1 as a
};
