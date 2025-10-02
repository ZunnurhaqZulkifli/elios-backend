import { ChevronDown, ChevronRight } from "lucide-react";
import { Link, usePage } from "@inertiajs/react";
import { useState } from "react";

export default function SidebarNavigation({ navigationMenus }) {
    const [expandedMenus, setExpandedMenus] = useState({});

    const currentRoute = route().current();

    const stripper = (str) => {
        var parts = str.split(".");
        return parts[0].toLowerCase();
    };

    const toggleSubmenu = (itemName) => {
        setExpandedMenus((prev) => ({
            ...prev,
            [itemName]: true,
        }));
    };

    const updatedNavigation = navigationMenus.map((item) => ({
        ...item,
        current:
            currentRoute === item.href ||
            stripper(currentRoute).includes(stripper(item.href)) ||
            (item.submenu &&
                item.submenu.some(
                    (sub) =>
                        currentRoute === sub.href ||
                        currentRoute.includes(sub.href) ||
                        stripper(currentRoute).includes(stripper(sub.href))
                )),
    }));

    const shouldExpand = (item) => {
        if (!item.submenu) return false;
        return (
            expandedMenus[item.name] ||
            item.submenu.some(
                (sub) =>
                    currentRoute === sub.href ||
                    currentRoute?.startsWith(sub.href + ".") ||
                    stripper(currentRoute).includes(stripper(sub.href))
            )
        );
    };

    return (
        <nav className="flex-1 space-y-1 px-4 py-4">
            {updatedNavigation.map((item) => {
                const Icon = item.icon;
                const hasSubmenu = item.submenu && item.submenu.length > 0;
                const isExpanded = shouldExpand(item);

                return (
                    <div key={item.name}>
                        {hasSubmenu ? (
                            <div>
                                <button
                                    onClick={() => toggleSubmenu(item.name)}
                                    className={`group w-full flex items-center justify-between rounded-md px-2 py-2 text-sm font-medium transition-colors ${
                                        item.current
                                            ? "bg-primary text-primary-foreground"
                                            : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"
                                    }`}
                                >
                                    <div className="flex items-center">
                                        <Icon className="mr-3 h-5 w-5" />
                                        {item.name}
                                    </div>
                                    <ChevronDown
                                        className={`h-4 w-4 transition-transform ${
                                            isExpanded ? "" : "rotate-180"
                                        }`}
                                    />
                                </button>
                                {isExpanded && (
                                    <div className="ml-6 mt-1 space-y-1">
                                        {item.submenu.map((subItem) => {
                                            const SubIcon = subItem.icon;
                                            let isSubCurrent =
                                                currentRoute === subItem.href ||
                                                currentRoute?.startsWith(
                                                    subItem.href + "."
                                                );

                                            const strippedCurrent =
                                                stripper(currentRoute);
                                            const strippedSubItem = stripper(
                                                subItem.href
                                            );

                                            const matchingSubmenus =
                                                item.submenu.filter((sub) =>
                                                    strippedCurrent.includes(
                                                        stripper(sub.href)
                                                    )
                                                );

                                            const shouldHighlight =
                                                isSubCurrent ||
                                                (matchingSubmenus.length ===
                                                    1 &&
                                                    strippedCurrent.includes(
                                                        strippedSubItem
                                                    )) ||
                                                (matchingSubmenus.length > 1 &&
                                                    isSubCurrent);

                                            // Check if this subItem has its own submenu
                                            const hasNestedSubmenu =
                                                subItem.submenu &&
                                                subItem.submenu.length > 0;
                                            const isNestedExpanded =
                                                expandedMenus[subItem.name] ||
                                                (subItem.submenu &&
                                                    subItem.submenu.some(
                                                        (nestedSub) =>
                                                            currentRoute ===
                                                                nestedSub.href ||
                                                            currentRoute?.startsWith(
                                                                nestedSub.href +
                                                                    "."
                                                            ) ||
                                                            stripper(
                                                                currentRoute
                                                            ).includes(
                                                                stripper(
                                                                    nestedSub.href
                                                                )
                                                            )
                                                    ));

                                            return (
                                                <div key={subItem.name}>
                                                    {hasNestedSubmenu ? (
                                                        <div>
                                                            <button
                                                                onClick={() =>
                                                                    toggleSubmenu(
                                                                        subItem.name
                                                                    )
                                                                }
                                                                className={`group w-full flex items-center justify-between rounded-md px-2 py-2 text-sm font-medium transition-colors ${
                                                                    shouldHighlight
                                                                        ? "bg-primary text-primary-foreground"
                                                                        : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"
                                                                }`}
                                                            >
                                                                <div className="flex items-center">
                                                                    <SubIcon className="mr-3 h-4 w-4" />
                                                                    {
                                                                        subItem.name
                                                                    }
                                                                </div>
                                                                <ChevronRight
                                                                    className={`h-3 w-3 transition-transform ${
                                                                        isNestedExpanded
                                                                            ? "rotate-90"
                                                                            : ""
                                                                    }`}
                                                                />
                                                            </button>
                                                            {isNestedExpanded && (
                                                                <div className="ml-6 mt-1 space-y-1">
                                                                    {subItem.submenu.map(
                                                                        (
                                                                            nestedItem
                                                                        ) => {
                                                                            const NestedIcon =
                                                                                nestedItem.icon;
                                                                            const isNestedCurrent =
                                                                                currentRoute ===
                                                                                    nestedItem.href ||
                                                                                currentRoute?.startsWith(
                                                                                    nestedItem.href +
                                                                                        "."
                                                                                );

                                                                            return (
                                                                                <Link
                                                                                    key={
                                                                                        nestedItem.name
                                                                                    }
                                                                                    href={route(
                                                                                        nestedItem.href
                                                                                    )}
                                                                                    className={`group flex items-center rounded-md px-2 py-2 text-xs font-medium transition-colors ${
                                                                                        isNestedCurrent
                                                                                            ? "bg-primary text-primary-foreground"
                                                                                            : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"
                                                                                    }`}
                                                                                >
                                                                                    <NestedIcon className="mr-3 h-3 w-3" />
                                                                                    {
                                                                                        nestedItem.name
                                                                                    }
                                                                                </Link>
                                                                            );
                                                                        }
                                                                    )}
                                                                </div>
                                                            )}
                                                        </div>
                                                    ) : (
                                                        <Link
                                                            href={route(
                                                                subItem.href
                                                            )}
                                                            className={`group flex items-center rounded-md px-2 py-2 text-sm font-medium transition-colors ${
                                                                shouldHighlight
                                                                    ? "bg-primary text-primary-foreground"
                                                                    : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"
                                                            }`}
                                                        >
                                                            <SubIcon className="mr-3 h-4 w-4" />
                                                            {subItem.name}
                                                        </Link>
                                                    )}
                                                </div>
                                            );
                                        })}
                                    </div>
                                )}
                            </div>
                        ) : (
                            <Link
                                href={route(item.href)}
                                className={`group flex items-center rounded-md px-2 py-2 text-sm font-medium transition-colors ${
                                    item.current
                                        ? "bg-primary text-primary-foreground"
                                        : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"
                                }`}
                            >
                                <Icon className="mr-3 h-5 w-5" />
                                {item.name}
                            </Link>
                        )}
                    </div>
                );
            })}
        </nav>
    );
}
