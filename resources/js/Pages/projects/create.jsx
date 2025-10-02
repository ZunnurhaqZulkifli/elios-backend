import { Button } from "@/components/ui/button";

import MasterLayout from "@/layouts/master-layout";
import { Link, usePage } from "@inertiajs/react";
import { Head } from "@inertiajs/react";
import { Minus, Plus } from "lucide-react";
import { useForm } from "react-hook-form";
import ProjectForm from "./partials/form";
import axios from "axios";
import { useMutation } from "@tanstack/react-query";

function createProject(data) {
    return axios.post("/projects", data);
}

export default function CreateProject(props) {
    const form = useForm({
        defaultValues: {
            ownerable_type: "",
            ownerable_id: "",
            pic: "",
            type_id: "",
            category_id: "",
            title: "",
            description: "",
            start_at: "",
            end_at: "",
            projected_end_at: "",
            status: "",
        },
    });

    const mutation = useMutation({
        mutationFn: createProject,
        onSuccess: (data) => {
            console.log("Project created successfully:", data);
        },
        onError: (error) => {
            console.error("Error creating project:", error);
        },
    });

    const handleSubmit = (data) => {
        console.log("Form Data:", data);
        mutation.mutate(data);
    };

    return (
        <MasterLayout
            header={
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">
                            Project
                        </h1>
                        <p className="text-muted-foreground">
                            Create a new project
                        </p>
                    </div>

                    <div className="flex items-center space-x-2">
                        <Link href={route("projects.index")}>
                            <Button
                                variant="outline"
                                href={route("projects.index")}
                            >
                                <Minus className="mr-2 h-4 w-4" />
                                Back to Projects
                            </Button>
                        </Link>
                        <Button
                            variant="primary"
                            href={route("projects.create")}
                        >
                            <Plus className="mr-2 h-4 w-4" />
                            New Project
                        </Button>
                    </div>
                </div>
            }
        >
            <Head title="Tasks" />
            <div className="container">
                <ProjectForm form={form} onSubmit={handleSubmit} />
            </div>
        </MasterLayout>
    );
}
