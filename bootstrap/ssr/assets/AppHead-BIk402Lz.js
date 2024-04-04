import { usePage, Head } from "@inertiajs/vue3";
import { useSSRContext, computed, mergeProps, withCtx, createVNode, openBlock, createBlock, Fragment, createCommentVNode } from "vue";
import { ssrRenderComponent, ssrRenderAttr } from "vue/server-renderer";
const socialBanner = "/build/assets/social-banner-B4Eaz7-E.png";
const _sfc_main = {
  __name: "AppHead",
  __ssrInlineRender: true,
  props: {
    title: {
      type: String,
      default: void 0
    },
    index: {
      type: Boolean,
      default: true
    },
    author: {
      type: String,
      default: "Senshudo"
    },
    authorTwitter: {
      type: String,
      required: false,
      default: null
    },
    ogType: {
      type: String,
      default: "website"
    },
    description: {
      type: String,
      default: "Senshudo, The Way Of The Player. Video game news and reviews."
    },
    thumbnail: {
      type: String,
      default: socialBanner
    },
    imageWidth: {
      type: String,
      default: "1200"
    },
    imageHeight: {
      type: String,
      default: "630"
    },
    imageAlt: {
      type: String,
      default: void 0
    },
    category: {
      type: String,
      required: false,
      default: null
    },
    publishedAt: {
      type: String,
      required: false,
      default: null
    },
    updatedAt: {
      type: String,
      required: false,
      default: null
    }
  },
  setup(__props) {
    const props = __props;
    const url = computed(() => usePage().props.location);
    const pageTitle = computed(
      () => props.title ? `${props.title} - Senshudo` : "Senshudo - The Way Of The Player"
    );
    return (_ctx, _push, _parent, _attrs) => {
      const _component_InertiaHead = Head;
      _push(ssrRenderComponent(_component_InertiaHead, mergeProps({ title: pageTitle.value }, _attrs), {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<link rel="canonical"${ssrRenderAttr("content", url.value)}${_scopeId}><meta name="description"${ssrRenderAttr("content", __props.description)}${_scopeId}><meta name="author"${ssrRenderAttr("content", __props.author)}${_scopeId}><meta name="robots"${ssrRenderAttr("content", __props.index ? "index, follow" : "noindex, nofollow")}${_scopeId}><meta property="fb:app_id" content="635861056474584"${_scopeId}><meta property="og:url"${ssrRenderAttr("content", url.value)}${_scopeId}><meta property="og:type"${ssrRenderAttr("content", __props.ogType)}${_scopeId}><meta property="og:title"${ssrRenderAttr("content", pageTitle.value)}${_scopeId}><meta property="og:description"${ssrRenderAttr("content", __props.description)}${_scopeId}><meta property="og:image"${ssrRenderAttr("content", __props.thumbnail)}${_scopeId}><meta property="og:image:width"${ssrRenderAttr("content", __props.imageWidth)}${_scopeId}><meta property="og:image:height"${ssrRenderAttr("content", __props.imageHeight)}${_scopeId}><meta property="og:image:alt"${ssrRenderAttr("content", __props.imageAlt ?? pageTitle.value)}${_scopeId}><meta property="og:locale" content="en_GB"${_scopeId}><meta property="og:site_name" content="Senshudo"${_scopeId}><meta name="twitter:title"${ssrRenderAttr("content", pageTitle.value)}${_scopeId}><meta name="twitter:description"${ssrRenderAttr("content", __props.description)}${_scopeId}><meta name="twitter:image"${ssrRenderAttr("content", __props.thumbnail)}${_scopeId}><meta name="twitter:card" content="summary_large_image"${_scopeId}>`);
            if (__props.ogType === "article") {
              _push2(`<!--[--><meta property="article:published_time"${ssrRenderAttr("content", __props.publishedAt)}${_scopeId}><meta property="article:modified_time"${ssrRenderAttr("content", __props.updatedAt)}${_scopeId}><meta property="og:updated_time"${ssrRenderAttr("content", __props.updatedAt)}${_scopeId}>`);
              if (__props.category) {
                _push2(`<meta property="article:section"${ssrRenderAttr("content", __props.category)}${_scopeId}>`);
              } else {
                _push2(`<!---->`);
              }
              if (__props.authorTwitter) {
                _push2(`<meta name="twitter:creator"${ssrRenderAttr("content", `@${__props.authorTwitter}`)}${_scopeId}>`);
              } else {
                _push2(`<!---->`);
              }
              _push2(`<!--]-->`);
            } else {
              _push2(`<!---->`);
            }
          } else {
            return [
              createVNode("link", {
                rel: "canonical",
                content: url.value
              }, null, 8, ["content"]),
              createVNode("meta", {
                name: "description",
                content: __props.description
              }, null, 8, ["content"]),
              createVNode("meta", {
                name: "author",
                content: __props.author
              }, null, 8, ["content"]),
              createVNode("meta", {
                name: "robots",
                content: __props.index ? "index, follow" : "noindex, nofollow"
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "fb:app_id",
                content: "635861056474584"
              }),
              createVNode("meta", {
                property: "og:url",
                content: url.value
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "og:type",
                content: __props.ogType
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "og:title",
                content: pageTitle.value
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "og:description",
                content: __props.description
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "og:image",
                content: __props.thumbnail
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "og:image:width",
                content: __props.imageWidth
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "og:image:height",
                content: __props.imageHeight
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "og:image:alt",
                content: __props.imageAlt ?? pageTitle.value
              }, null, 8, ["content"]),
              createVNode("meta", {
                property: "og:locale",
                content: "en_GB"
              }),
              createVNode("meta", {
                property: "og:site_name",
                content: "Senshudo"
              }),
              createVNode("meta", {
                name: "twitter:title",
                content: pageTitle.value
              }, null, 8, ["content"]),
              createVNode("meta", {
                name: "twitter:description",
                content: __props.description
              }, null, 8, ["content"]),
              createVNode("meta", {
                name: "twitter:image",
                content: __props.thumbnail
              }, null, 8, ["content"]),
              createVNode("meta", {
                name: "twitter:card",
                content: "summary_large_image"
              }),
              __props.ogType === "article" ? (openBlock(), createBlock(Fragment, { key: 0 }, [
                createVNode("meta", {
                  property: "article:published_time",
                  content: __props.publishedAt
                }, null, 8, ["content"]),
                createVNode("meta", {
                  property: "article:modified_time",
                  content: __props.updatedAt
                }, null, 8, ["content"]),
                createVNode("meta", {
                  property: "og:updated_time",
                  content: __props.updatedAt
                }, null, 8, ["content"]),
                __props.category ? (openBlock(), createBlock("meta", {
                  key: 0,
                  property: "article:section",
                  content: __props.category
                }, null, 8, ["content"])) : createCommentVNode("", true),
                __props.authorTwitter ? (openBlock(), createBlock("meta", {
                  key: 1,
                  name: "twitter:creator",
                  content: `@${__props.authorTwitter}`
                }, null, 8, ["content"])) : createCommentVNode("", true)
              ], 64)) : createCommentVNode("", true)
            ];
          }
        }),
        _: 1
      }, _parent));
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/AppHead.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as _
};
