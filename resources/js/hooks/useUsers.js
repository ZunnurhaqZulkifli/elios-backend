import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import { usersApi } from "../services/api";

// Query keys
export const QUERY_KEYS = {
    USERS: "users",
    USER: "user",
    USERS_SEARCH: "users_search",
};

// Get all users
export const useUsers = (params = {}) => {
    return useQuery({
        queryKey: [QUERY_KEYS.USERS, params],
        queryFn: () => usersApi.getUsers(params),
        staleTime: 5 * 60 * 1000, // 5 minutes
        cacheTime: 10 * 60 * 1000, // 10 minutes
    });
};

// Get single user
export const useUser = (id) => {
    return useQuery({
        queryKey: [QUERY_KEYS.USER, id],
        queryFn: () => usersApi.getUser(id),
        enabled: !!id, // Only run if id exists
        staleTime: 5 * 60 * 1000,
        cacheTime: 10 * 60 * 1000,
    });
};

// Search users
export const useUsersSearch = (query) => {
    return useQuery({
        queryKey: [QUERY_KEYS.USERS_SEARCH, query],
        queryFn: () => usersApi.searchUsers(query),
        enabled: !!query && query.length > 2, // Only search if query has more than 2 characters
        staleTime: 2 * 60 * 1000, // 2 minutes for search results
        cacheTime: 5 * 60 * 1000,
    });
};

// Create user mutation
export const useCreateUser = () => {
    const queryClient = useQueryClient();

    return useMutation({
        mutationFn: usersApi.createUser,
        onSuccess: (data) => {
            // Invalidate and refetch users list
            queryClient.invalidateQueries({ queryKey: [QUERY_KEYS.USERS] });

            // Optionally add the new user to the cache
            queryClient.setQueryData([QUERY_KEYS.USER, data.id], data);
        },
        onError: (error) => {
            console.error("Error creating user:", error);
        },
    });
};

// Update user mutation
export const useUpdateUser = () => {
    const queryClient = useQueryClient();

    return useMutation({
        mutationFn: ({ id, userData }) => usersApi.updateUser(id, userData),
        onSuccess: (data, variables) => {
            // Update the specific user in cache
            queryClient.setQueryData([QUERY_KEYS.USER, variables.id], data);

            // Invalidate users list to refresh
            queryClient.invalidateQueries({ queryKey: [QUERY_KEYS.USERS] });
        },
        onError: (error) => {
            console.error("Error updating user:", error);
        },
    });
};

// Delete user mutation
export const useDeleteUser = () => {
    const queryClient = useQueryClient();

    return useMutation({
        mutationFn: usersApi.deleteUser,
        onSuccess: (data, deletedId) => {
            // Remove user from cache
            queryClient.removeQueries({
                queryKey: [QUERY_KEYS.USER, deletedId],
            });

            // Invalidate users list
            queryClient.invalidateQueries({ queryKey: [QUERY_KEYS.USERS] });
        },
        onError: (error) => {
            console.error("Error deleting user:", error);
        },
    });
};
