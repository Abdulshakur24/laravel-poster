import { defineStore } from "pinia";

const getOSTheme = window.matchMedia("(prefers-color-scheme: dark)");

export const useThemeStore = defineStore({
    id: "theme",
    state: () => ({
        currentTheme:
            localStorage.getItem("currentTheme") ||
            (getOSTheme.matches ? "dark" : "light"),
        isOnOSTheme: !("currentTheme" in localStorage) && getOSTheme.matches,
    }),
    actions: {
        toggleTheme() {
            if (this.isOnOSTheme) this.isOnOSTheme = false;
            const currentTheme = this.currentTheme;

            if (currentTheme === "light") {
                localStorage.setItem("currentTheme", "dark");
                this.currentTheme = "dark";
            } else {
                localStorage.setItem("currentTheme", "light");
                this.currentTheme = "light";
            }
        },
        setOSTheme() {
            this.isOnOSTheme = true;
            this.determineTheme();
            localStorage.removeItem("currentTheme");
        },
        determineTheme() {
            if (
                localStorage.currentTheme === "dark" ||
                (!("currentTheme" in localStorage) &&
                    window.matchMedia("(prefers-color-scheme: dark)").matches)
            ) {
                this.currentTheme = "dark";
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        },
    },
});
