import { Home, Plus, Settings, Users } from "lucide-react";

const navigationMenus = [
    { name: "Dashboard", href: "dashboard", icon: Home, current: false },
    {
        name: "Tasks",
        href: "tasks.index",
        icon: Users,
        current: false,
        submenu: [
            {
                name: "Tasks",
                href: "tasks.index",
                icon: Users,
                submenu: [
                    { name: "All Tasks", href: "tasks.index", icon: Users },
                    // { name: 'Active Tasks', href: 'tasks.create', icon: Users },
                    // { name: 'Completed Tasks', href: 'tasks.create', icon: Users },
                ],
            },
            { name: "Create Task", href: "tasks.create", icon: Plus },
        ],
    },
    {
        name: "Application Settings",
        href: "projects.index",
        icon: Users,
        current: false,
        submenu: [
            {
                name: "Projects",
                href: "projects.index",
                icon: Settings,
                current: false,
                submenu: [
                    {
                        name: "All Projects",
                        href: "projects.index",
                        icon: Settings,
                    },
                    {
                        name: "Create Project",
                        href: "projects.create",
                        icon: Settings,
                    },
                ],
            },
            { name: "Users", href: "users.index", icon: Users, current: false },
            {
                name: "Settings",
                href: "settings.index",
                icon: Settings,
                current: false,
            },
        ],
    },
];

export default navigationMenus;
