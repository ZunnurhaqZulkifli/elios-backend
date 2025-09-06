import { useState } from 'react';
import { Link, usePage } from '@inertiajs/react';

import {
    Bell,
    ChevronDown,
    Home,
    LogOut,
    Menu,
    Search,
    User,
    Users,
    X,
} from 'lucide-react';

import { Avatar, AvatarFallback, AvatarImage } from '@/Components/ui/avatar';
import { Badge } from '@/Components/ui/badge';
import { Button } from '@/Components/ui/button';
import { Card, CardContent } from '@/Components/ui/card';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { Input } from '@/Components/ui/input';
import { Separator } from '@/Components/ui/separator';
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet';
import ApplicationLogo from '@/Components/ApplicationLogo';

const navigation = [
    { name: 'Dashboard', href: 'dashboard', icon: Home, current: false },
    { name: 'Users', href: 'users.index', icon: Users, current: false },
    // { name: 'Settings', href: 'settings', icon: ChevronDown, current: false },
];

export default function ModernLayout({ header, children, title }) {
    const user = usePage().props.auth.user;
    const [sidebarOpen, setSidebarOpen] = useState(false);

    // Update current navigation based on current route
    const currentRoute = route().current();
    const updatedNavigation = navigation.map(item => ({
        ...item,
        current: currentRoute === item.href || currentRoute?.startsWith(item.href + '.')
    }));

    const SidebarContent = () => (
        <div className="flex h-full flex-col">
            {/* Logo */}
            <div className="flex h-16 shrink-0 items-center px-4">
                <Link href="/" className="flex items-center space-x-2">
                    <ApplicationLogo className="h-8 w-8" />
                    <span className="text-xl font-bold">Elios</span>
                </Link>
            </div>

            {/* Navigation */}
            <nav className="flex-1 space-y-1 px-4 py-4">
                {updatedNavigation.map((item) => {
                    const Icon = item.icon;
                    return (
                        <Link
                            key={item.name}
                            href={route(item.href)}
                            className={`group flex items-center rounded-md px-2 py-2 text-sm font-medium transition-colors ${
                                item.current
                                    ? 'bg-primary text-primary-foreground'
                                    : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground'
                            }`}
                        >
                            <Icon className="mr-3 h-5 w-5" />
                            {item.name}
                        </Link>
                    );
                })}
            </nav>

            {/* User info at bottom */}
            <div className="border-t p-4">
                <div className="flex items-center space-x-3">
                    <Avatar className="h-8 w-8">
                        <AvatarImage src={user.avatar} alt={user.name} />
                        <AvatarFallback>
                            {user.name?.charAt(0)?.toUpperCase() || 'U'}
                        </AvatarFallback>
                    </Avatar>
                    <div className="flex-1 min-w-0">
                        <p className="text-sm font-medium truncate">{user.name}</p>
                        <p className="text-xs text-muted-foreground truncate">{user.email}</p>
                    </div>
                </div>
            </div>
        </div>
    );

    return (
        <div className="min-h-screen bg-background">
            {/* Mobile sidebar */}
            <Sheet open={sidebarOpen} onOpenChange={setSidebarOpen}>
                <SheetTrigger asChild>
                    <Button
                        variant="ghost"
                        size="sm"
                        className="fixed top-4 left-4 z-40 md:hidden"
                    >
                        <Menu className="h-5 w-5" />
                    </Button>
                </SheetTrigger>
                <SheetContent side="left" className="p-0 w-64">
                    <SidebarContent />
                </SheetContent>
            </Sheet>

            {/* Desktop sidebar */}
            <div className="hidden md:fixed md:inset-y-0 md:z-50 md:flex md:w-64 md:flex-col">
                <Card className="flex-1 border-r-0 rounded-none">
                    <CardContent className="p-0 h-full">
                        <SidebarContent />
                    </CardContent>
                </Card>
            </div>

            {/* Main content */}
            <div className="md:pl-64">
                {/* Top header */}
                <header className="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60 px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                    {/* Search */}
                    <div className="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                        <div className="relative flex flex-1 items-center">
                            <Search className="pointer-events-none absolute left-3 h-4 w-4 text-muted-foreground" />
                            <Input
                                placeholder="Search..."
                                className="pl-9 w-full max-w-md"
                            />
                        </div>
                    </div>

                    {/* Right side */}
                    <div className="flex items-center gap-x-4 lg:gap-x-6">
                        {/* Notifications */}
                        <Button variant="ghost" size="sm" className="relative">
                            <Bell className="h-5 w-5" />
                            <Badge
                                variant="destructive"
                                className="absolute -top-1 -right-1 h-5 w-5 rounded-full p-1"
                            >
                                3
                            </Badge>
                        </Button>

                        <Separator orientation="vertical" className="h-6" />

                        {/* Profile dropdown */}
                        <DropdownMenu>
                            <DropdownMenuTrigger asChild>
                                <Button variant="ghost" className="relative h-8 w-8 rounded-full">
                                    <Avatar className="h-8 w-8">
                                        <AvatarImage src={user.avatar} alt={user.name} />
                                        <AvatarFallback>
                                            {user.name?.charAt(0)?.toUpperCase() || 'U'}
                                        </AvatarFallback>
                                    </Avatar>
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent className="w-56" align="end" forceMount>
                                <DropdownMenuLabel className="font-normal">
                                    <div className="flex flex-col space-y-1">
                                        <p className="text-sm font-medium leading-none">{user.name}</p>
                                        <p className="text-xs leading-none text-muted-foreground">
                                            {user.email}
                                        </p>
                                    </div>
                                </DropdownMenuLabel>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem asChild>
                                    <Link href={route('profile.edit')} className="cursor-pointer">
                                        <User className="mr-2 h-4 w-4" />
                                        <span>Profile</span>
                                    </Link>
                                </DropdownMenuItem>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem asChild>
                                    <Link
                                        href={route('logout')}
                                        method="post"
                                        as="button"
                                        className="cursor-pointer w-full"
                                    >
                                        <LogOut className="mr-2 h-4 w-4" />
                                        <span>Log out</span>
                                    </Link>
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </header>

                {/* Page header */}
                {header && (
                    <div className="bg-background px-4 py-6 sm:px-6 lg:px-8">
                        <div className="border-b pb-4">
                            {header}
                        </div>
                    </div>
                )}

                {/* Main content */}
                <main className="px-4 py-6 sm:px-6 lg:px-8">
                    {children}
                </main>
            </div>
        </div>
    );
}
