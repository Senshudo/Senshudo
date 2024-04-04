import { _ as _sfc_main$2 } from "./LiveStream-nQSKXxpT.js";
import { _ as _sfc_main$1 } from "./AppHead-BIk402Lz.js";
import { mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderList, ssrInterpolate } from "vue/server-renderer";
import "../ssr.js";
import dayjs from "dayjs";
import "laravel-echo";
import "pusher-js";
import "@inertiajs/vue3";
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
  __name: "schedule",
  __ssrInlineRender: true,
  setup(__props) {
    const times = [
      {
        day: "Sunday",
        events: [
          {
            start: "21:00",
            end: "01:00",
            timezone: "UTC",
            title: "Freebird"
          }
        ]
      },
      { day: "Monday", events: null },
      {
        day: "Tuesday",
        events: [{ start: "23:00", end: "03:00", timezone: "UTC", title: "Freebird" }]
      },
      { day: "Wednesday", events: null },
      { day: "Thursday", events: null },
      {
        day: "Friday",
        events: [
          {
            start: "18:00",
            end: "22:00",
            timezone: "UTC",
            title: "RBMArtworks"
          }
        ]
      },
      {
        day: "Saturday",
        events: [
          {
            start: "18:00",
            end: "22:00",
            timezone: "UTC",
            title: "SweptSquash"
          }
        ]
      }
    ];
    function setTime(day, time) {
      const [hour, minute] = time.split(":");
      return dayjs().day(day).utc().set("hour", parseInt(hour)).set("minute", parseInt(minute)).format("HH:mm z");
    }
    return (_ctx, _push, _parent, _attrs) => {
      const _component_AppHead = _sfc_main$1;
      const _component_LiveStream = _sfc_main$2;
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "mx-auto max-w-7xl p-4 pt-8 dark:text-white" }, _attrs))}>`);
      _push(ssrRenderComponent(_component_AppHead, { title: "Schedule" }, null, _parent));
      _push(ssrRenderComponent(_component_LiveStream, null, null, _parent));
      _push(`<!--[-->`);
      ssrRenderList(times, (weekDay, index) => {
        _push(`<div><h2 class="my-4 text-2xl font-bold">${ssrInterpolate(weekDay.day)}</h2>`);
        if (weekDay.events) {
          _push(`<div class="grid grid-cols-1 gap-4"><!--[-->`);
          ssrRenderList(weekDay.events, (event, eventIndex) => {
            _push(`<div class="bg-base-100/20 p-4 shadow dark:bg-neutral"><div class="flex justify-between"><h3 class="text-lg font-bold">${ssrInterpolate(event.title)}</h3><p class="text-sm">${ssrInterpolate(setTime(index, event.start))} - ${ssrInterpolate(setTime(index, event.end))}</p></div></div>`);
          });
          _push(`<!--]--></div>`);
        } else {
          _push(`<div class="bg-base-100/20 p-4 text-center shadow dark:bg-neutral"> No Scheduled Streams </div>`);
        }
        _push(`</div>`);
      });
      _push(`<!--]--></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/schedule.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
