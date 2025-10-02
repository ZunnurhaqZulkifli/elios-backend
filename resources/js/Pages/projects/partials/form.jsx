import { Button } from "@/components/ui/button";

import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Textarea } from "@/components/ui/textarea";

export default function ProjectForm({ form, onSubmit }) {
    const types = [
        { id: 1, name: "Work Sands" },
        { id: 2, name: "Personal Project" },
    ];

    function findType(id, field) {
        var selectedType = types.find((type) => type.id === parseInt(id));

        if (selectedType) {
            field.onChange(selectedType.id);
            form.setValue("type_id", selectedType.id);
        }
    }

    const categories = [
        { id: 1, name: "Frontend" },
        { id: 2, name: "Backend" },
        { id: 3, name: "Mobile" },
        { id: 4, name: "Design" },
    ];

    function findCategory(id, field) {
        var selectedCategory = categories.find(
            (category) => category.id === parseInt(id)
        );

        if (selectedCategory) {
            field.onChange(selectedCategory.id);
            form.setValue("category_id", selectedCategory.id);
        }
    }

    const owners = [
        { id: 1, name: "Zunnurhaq Zulkifli", type: "App\\Models\\User" },
    ];

    function findOwner(id, field) {
        var selectedOwner = owners.find((owner) => owner.id === parseInt(id));

        if (selectedOwner) {
            field.onChange(selectedOwner.id);
            form.setValue("ownerable_id", selectedOwner.id);
            form.setValue("ownerable_type", selectedOwner.type);
        }
    }

    return (
        <Form {...form}>
            <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8">
                <div className="grid grid-cols-2 gap-6">
                    <FormField
                        control={form.control}
                        name="ownerable_id"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel>Project Owner</FormLabel>
                                <FormControl>
                                    <Select
                                        onValueChange={function (
                                            selectedValue
                                        ) {
                                            return findOwner(
                                                selectedValue,
                                                field
                                            );
                                        }}
                                        defaultValue={field.value?.toString()}
                                    >
                                        <SelectTrigger className="w-full">
                                            <SelectValue placeholder="Please Select" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {owners.map((owner) => (
                                                <SelectItem
                                                    value={owner.id.toString()}
                                                    key={owner.id}
                                                >
                                                    {owner.name}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </FormControl>
                            </FormItem>
                        )}
                    />

                    <FormField
                        control={form.control}
                        name="title"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel>Project Title</FormLabel>
                                <FormControl>
                                    <Input placeholder="mywakalah" {...field} />
                                </FormControl>
                            </FormItem>
                        )}
                    />

                    <FormField
                        control={form.control}
                        name="description"
                        render={({ field }) => (
                            <FormItem className="col-span-2">
                                <FormLabel>Project Description</FormLabel>
                                <FormControl>
                                    <Textarea
                                        placeholder="System for...."
                                        {...field}
                                    />
                                </FormControl>
                            </FormItem>
                        )}
                    />

                    <FormField
                        control={form.control}
                        name="type_id"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel>Project Type</FormLabel>
                                <FormControl>
                                    <Select
                                        onValueChange={function (
                                            selectedValue
                                        ) {
                                            return findType(
                                                selectedValue,
                                                field
                                            );
                                        }}
                                        defaultValue={field.value?.toString()}
                                    >
                                        <SelectTrigger className="w-full">
                                            <SelectValue placeholder="Please Select" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {types.map((type) => (
                                                <SelectItem
                                                    value={type.id.toString()}
                                                    key={type.id}
                                                >
                                                    {type.name}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </FormControl>
                            </FormItem>
                        )}
                    />

                    <FormField
                        control={form.control}
                        name="category_id"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel>Project Category</FormLabel>
                                <FormControl>
                                    <Select
                                        onValueChange={function (
                                            selectedValue
                                        ) {
                                            return findCategory(
                                                selectedValue,
                                                field
                                            );
                                        }}
                                        defaultValue={field.value?.toString()}
                                    >
                                        <SelectTrigger className="w-full">
                                            <SelectValue placeholder="Please Select" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {categories.map((category) => (
                                                <SelectItem
                                                    value={category.id.toString()}
                                                    key={category.id}
                                                >
                                                    {category.name}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </FormControl>
                            </FormItem>
                        )}
                    />
                </div>

                <Button type="submit">Submit</Button>
            </form>
        </Form>
    );
}
