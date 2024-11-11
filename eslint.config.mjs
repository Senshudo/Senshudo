import eslint from '@eslint/js'
import eslintPluginPrettierRecommended from 'eslint-plugin-prettier/recommended'
import pluginVue from 'eslint-plugin-vue'
import autoImports from './.eslintrc-auto-import.json' with { type: 'json' }

export default [
    eslint.configs.recommended,
    ...pluginVue.configs['flat/recommended'],
    eslintPluginPrettierRecommended,
    {
        ignores: [
            'app/**/*',
            'bootstrap/**/*',
            'config/**/*',
            'database/**/*',
            'node_modules/**/*',
            'public/**/*',
            'routes/**/*',
            'storage/**/*',
            'tests/**/*',
            'vendor/**/*',
        ],
    },
    {
        languageOptions: autoImports,
        rules: {
            'vue/multi-word-component-names': 'off',
        },
    },
    {
        files: ['*.js', '*.mjs', '*.vue'],
        ignores: ['*.md', 'package-lock.json', '*.d.ts'],
        rules: {
            'comma-dangle': ['error', 'always-multiline'],
            'prettier/prettier': 'warn',
            'vue/component-name-in-template-casing': ['error', 'PascalCase'],
            'vue/component-tags-order': ['error', { order: ['script', 'template', 'style'] }],
            'vue/define-macros-order': ['warn', { order: ['defineProps', 'defineEmits'] }],
            'vue/multi-word-component-names': 'off',
            'vue/no-template-target-blank': [
                'error',
                { allowReferrer: false, enforceDynamicLinks: 'always' },
            ],
            'vue/no-ref-object-reactivity-loss': 'error',
            'vue/no-unused-refs': 'warn',
            'vue/no-useless-v-bind': 'error',
            'vue/no-v-html': 'off',
            'no-undef': 'off',
            'no-unused-vars': 'off',
            'no-console': ['warn'],
        },
    },
]
