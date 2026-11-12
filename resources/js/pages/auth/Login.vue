<script lang="ts" setup>
import {Form, Head} from '@inertiajs/vue3';
import InputError from '@/components/forms/InputError.vue';
import PasswordInput from '@/components/forms/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import {Button} from '@/components/ui/button';
import {Checkbox} from '@/components/ui/checkbox';
import {Input} from '@/components/ui/input';
import {Label} from '@/components/ui/label';
import {Spinner} from '@/components/ui/spinner';
import {register} from '@/routes';
import {store} from '@/routes/login';
import {request} from '@/routes/password';

defineOptions({
    layout: {
        title: 'Log in to your account',
        description: 'Enter your email and password below to log in',
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <Head title="Log in"/>

    <div
        v-if="status"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        {{ status }}
    </div>

    <Form
        v-slot="{ errors, processing }"
        :reset-on-success="['password']"
        class="flex flex-col gap-6"
        v-bind="store.form()"
    >
        <div class="grid gap-6">
            <div class="grid gap-2">
                <Label for="email">Email address</Label>
                <Input
                    id="email"
                    v-focus
                    :tabindex="1"
                    autocomplete="email"
                    name="email"
                    placeholder="email@example.com"
                    required
                    type="email"
                />
                <InputError :message="errors.email"/>
            </div>

            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <Label for="password">Password</Label>
                    <TextLink
                        v-if="canResetPassword"
                        :href="request()"
                        :tabindex="5"
                        class="text-sm"
                    >
                        Forgot your password?
                    </TextLink>
                </div>
                <PasswordInput
                    id="password"
                    :tabindex="2"
                    autocomplete="current-password"
                    name="password"
                    placeholder="Password"
                    required
                />
                <InputError :message="errors.password"/>
            </div>

            <div class="flex items-center justify-between">
                <Label class="flex items-center space-x-3" for="remember">
                    <Checkbox id="remember" :tabindex="3" name="remember"/>
                    <span>Remember me</span>
                </Label>
            </div>

            <Button
                :disabled="processing"
                :tabindex="4"
                class="mt-4 w-full"
                data-test="login-button"
                type="submit"
            >
                <Spinner v-if="processing"/>
                Log in
            </Button>
        </div>

        <div class="text-center text-sm text-muted-foreground">
            Don't have an account?
            <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
        </div>
    </Form>
</template>
