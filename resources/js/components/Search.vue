<script lang="ts" setup>
import { ArrowPathIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { onClickOutside, onKeyUp, watchDebounced } from '@vueuse/core'

const showModal = ref(false)

const isLoading = ref(false)

const search = ref('')

const searchInput = ref<HTMLInputElement | null>(null)

const hasResults = ref(false)

const results = ref<App.Article[]>([])

const searchBox = ref(null)

const isMac = computed(() =>
    typeof navigator !== 'undefined' ? navigator.userAgent.includes('Mac OS') : false,
)

usePlatformShortcut('k', () => (!showModal.value ? (showModal.value = true) : undefined))

onClickOutside(searchBox, handleClose)

onKeyUp('Escape', handleClose)

watch(
    () => showModal,
    (value) => {
        if (value) {
            setTimeout(() => searchInput.value?.focus(), 500)
        }
    },
    {
        immediate: true,
        deep: true,
    },
)

watchDebounced(search, () => handleSearch(), { debounce: 500, maxWait: 1000 })

async function handleSearch() {
    if (search.value.trim() === '') {
        return
    }

    await useAxios()
        .get<App.Article[]>('/search', { params: { q: search.value.trim() } })
        .then((response) => {
            results.value = response.data
            hasResults.value = true
        })
        .catch(() => {
            hasResults.value = false
        })
}

function handleRedirect(item: App.Article) {
    navigateTo(`/news/${item.slug}`)

    handleClose()
}

function handleClose() {
    search.value = ''
    results.value = []
    hasResults.value = false
    showModal.value = false
}
</script>

<template>
    <div class="hidden w-full max-w-lg sm:block lg:max-w-xs">
        <label for="search" class="sr-only">Search</label>
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </div>
            <div class="absolute inset-y-[0.3rem] right-1 space-x-1">
                <kbd class="kbd">{{ isMac ? '⌘' : 'Ctrl' }}</kbd>
                <kbd class="kbd">K</kbd>
            </div>
            <input
                id="search"
                name="search"
                class="dark:border-base-content/20 dark:bg-base-100 dark:ring-base-content/10 dark:focus:border-base-content dark:focus:ring-base-content block w-full rounded-md border-0 bg-white py-1.5 pr-3 pl-10 text-gray-900 ring-1 ring-gray-300 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 focus:ring-inset sm:text-sm sm:leading-6"
                placeholder="Search"
                type="search"
                @click="showModal = true"
            />
        </div>
    </div>
    <button class="block sm:hidden">
        <MagnifyingGlassIcon
            class="h-6 w-6 align-middle text-gray-400"
            aria-hidden="true"
            @click="showModal = true"
        />
    </button>

    <div class="relative z-50" role="dialog" aria-modal="true" title="Search">
        <transition
            enter-from-class="opacity-0"
            enter-active-class="ease-in-out transition-all duration-300"
            enter-to-class="opacity-100"
            leave-from-class="opacity-100"
            leave-active-class="ease-in-out transition-all duration-300"
            leave-to-class="opacity-0"
        >
            <div v-if="showModal" class="fixed inset-0 bg-slate-900/25 backdrop-blur"></div>
        </transition>

        <transition
            enter-from-class="duration-300 ease-out"
            enter-active-class="scale-95 opacity-0"
            enter-to-class="scale-100 opacity-100"
            leave-from-class="scale-100 opacity-100"
            leave-active-class="duration-200 ease-in"
            leave-to-class="scale-95 opacity-0"
        >
            <div
                v-if="showModal"
                class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 pt-20 sm:p-6 md:p-20"
            >
                <div
                    ref="searchBox"
                    class="ring-opacity-5 dark:divide-base-content dark:bg-neutral mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black transition-all"
                >
                    <div class="relative flex items-center gap-3 px-4">
                        <MagnifyingGlassIcon
                            class="dark:text-base-content h-6 w-6 align-middle text-gray-500"
                            aria-hidden="true"
                        />

                        <input
                            ref="searchInput"
                            v-model="search"
                            type="text"
                            class="dark:text-base-content dark:placeholder-base-content/40 h-12 flex-1 border-0 bg-transparent text-gray-900 placeholder:text-gray-400 focus:border-0 focus:ring-0 focus:outline-none dark:focus:border-0 dark:focus:ring-0"
                            placeholder="Search..."
                            role="combobox"
                            aria-expanded="false"
                            aria-controls="options"
                        />

                        <ArrowPathIcon
                            v-if="isLoading"
                            class="dark:text-base-content h-6 w-6 animate-spin align-middle text-gray-500"
                        />
                    </div>

                    <template v-if="!isLoading">
                        <p
                            v-if="hasResults && results.length === 0"
                            class="p-4 text-sm text-gray-500"
                        >
                            No results found.
                        </p>

                        <ul
                            v-else-if="hasResults && results.length > 0"
                            id="options"
                            class="max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800"
                        >
                            <li
                                v-for="(item, index) in results"
                                :key="`searchResult${index}`"
                                role="option"
                                class="dark:text-base-content/80 dark:hover:bg-base-100 dark:hover:text-base-content flex cursor-pointer items-center gap-3 px-4 py-2 transition-all select-none hover:bg-gray-500 hover:text-white"
                                tabindex="-1"
                                @click="handleRedirect(item)"
                            >
                                <span class="flex-1 truncate overflow-hidden font-semibold">
                                    {{ item.title }}
                                </span>
                                <span class="italic">{{ item.author?.name }}</span>
                            </li>
                        </ul>
                    </template>
                </div>
            </div>
        </transition>
    </div>
</template>
