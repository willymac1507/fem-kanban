<script lang="ts" setup>
import {Form, Head, usePage} from '@inertiajs/vue3';
import {computed} from 'vue';
import ProfileController
    from '@/actions/App/Http/Controllers/Settings/ProfileController';
import DeleteUser from '@/components/user/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/forms/InputError.vue';
import {Button} from '@/components/ui/button';
import {Input} from '@/components/ui/input';
import {Label} from '@/components/ui/label';
import {edit} from '@/routes/profile';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Profile settings',
                href: edit(),
            },
        ],
    },
});

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Profile settings"/>

    <h1 class="sr-only">Profile settings</h1>

    <div class="flex flex-col space-y-6">
        <Heading
            description="Update your name and email address"
            title="Profile"
            variant="small"
        />

        <Form
            v-slot="{ errors, processing }"
            class="space-y-6"
            v-bind="ProfileController.update.form()"
        >
            <div class="grid gap-2">
                <Label for="name">Name</Label>
                <Input
                    id="name"
                    :default-value="user.name"
                    autocomplete="name"
                    class="mt-1 block w-full"
                    name="name"
                    placeholder="Full name"
                    required
                />
                <InputError :message="errors.name" class="mt-2"/>
            </div>

            <div class="grid gap-2">
                <Label for="email">Email address</Label>
                <Input
                    id="email"
                    :default-value="user.email"
                    autocomplete="username"
                    class="mt-1 block w-full"
                    name="email"
                    placeholder="Email address"
                    required
                    type="email"
                />
                <InputError :message="errors.email" class="mt-2"/>
            </div>

            <div class="flex items-center gap-4">
                <Button :disabled="processing" data-test="update-profile-button"
                >Save
                </Button
                >
            </div>
        </Form>
    </div>

    <DeleteUser/>
</template>
