import { useSSRContext, ref, onMounted, onBeforeUnmount, unref, mergeProps } from "vue";
import { ssrRenderAttrs, ssrRenderAttr } from "vue/server-renderer";
import Echo from "laravel-echo";
import Pusher from "pusher-js";
const useEcho = () => {
  const options = {
    broadcaster: "reverb",
    cluster: "",
    key: "tddyig8u5rhcqqplj7w7",
    wsHost: "localhost",
    wsPort: "8081",
    wssPort: "8081",
    forceTLS: false,
    enabledTransports: ["ws", "wss"]
  };
  if (!options.key) {
    return null;
  }
  Pusher.logToConsole = true;
  return new Echo({
    ...options,
    client: new Pusher(options.key, options)
  });
};
const _sfc_main = {
  __name: "LiveStream",
  __ssrInlineRender: true,
  setup(__props) {
    const echo = useEcho();
    const activeChannel = ref("senshudo");
    const isLive = ref(false);
    onMounted(() => {
      echo == null ? void 0 : echo.listen("stream", "LiveStreamUpdated", (event) => {
        if (event.isLive) {
          isLive.value = true;
          activeChannel.value = event.channel;
        } else {
          isLive.value = false;
        }
      });
    });
    onBeforeUnmount(() => {
      echo == null ? void 0 : echo.leave("stream");
    });
    return (_ctx, _push, _parent, _attrs) => {
      if (unref(isLive)) {
        _push(`<div${ssrRenderAttrs(mergeProps({ class: "mb-4 flex flex-col gap-4 lg:flex-row" }, _attrs))}><div class="flex-1"><div class="aspect-h-9 aspect-w-16 overflow-hidden rounded"><iframe${ssrRenderAttr("src", `https://player.twitch.tv/?channel=${unref(activeChannel)}&autoplay=true&muted=true&parent=senshudo.tv`)} frameborder="0" allowfullscreen="true" scrolling="no"></iframe></div></div><iframe id="twitch-chat-embed"${ssrRenderAttr("src", `https://www.twitch.tv/embed/${unref(activeChannel)}/chat?parent=senshudo.tv`)} class="hidden rounded sm:flex md:min-w-[350px]"></iframe></div>`);
      } else {
        _push(`<!---->`);
      }
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/LiveStream.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as _
};
